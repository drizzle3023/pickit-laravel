<?php


namespace App\Http\Controllers;

use App\Http\Models\Categories;
use App\Http\Models\Customers;
use App\Http\Models\Products;
use App\Http\Utils\Utils;
use Illuminate\Support\Facades\Hash;
use Validator;
use function foo\func;


class APIController
{
    public function doLogin()
    {
        $validation = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            return Utils::makeResponse([], config('constants.response-message.invalid-params'));
        }

        $credentials = request(['email', 'password']);

        $user = Customers::select('id','password','first_name', 'last_name', 'email', 'template_no', 'category_background_color',
            'banner_color', 'font_color', 'product_background_color', 'company_logo')
            ->where([
                ['email', $credentials['email']],
                ['enable_flag', 1],
            ])->first();

        if ($user == null) {
            return Utils::makeResponse([], config('constants.response-message.invalid-credentials'));
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return Utils::makeResponse([], config('constants.response-message.invalid-credentials'));
        }

        if (!$token = auth()->attempt($credentials)) {
            return Utils::makeResponse([], config('constants.response-message.error-generate-api-token'));
        }

        $categoryList = Categories::select('id', 'name', 'name_second', 'rtl_direction')->where([
            ['customer_id', $user->id],
            ['show_flag', 1],
        ])->orderBy('show_order')->with(['products' => function($query) {
            $query->
            select('category_id','name','name_second','picture','video_id','price','description','description_second','video_url','currency_id')->
                where('show_flag', 1);
            ;
        }])->get();

        $user = $user->setHidden([
            'password'
        ]);

        return Utils::makeResponse([
            'api_token' => $token,
            'user' => $user,
            'category_array' => $categoryList
        ]);
    }

    public function getCategoriesByClient()
    {
        $email = request('email');
        $client = Customers::where('email', $email)->first();

        if (!isset($client)) {
            return Utils::makeResponse([], config('constants.response-message.invalid-params'));
        }

        $categoryList = Categories::select('id', 'name', 'name_second', 'rtl_direction')->where([
            ['customer_id', $client->id],
            ['show_flag', 1],
        ])->orderBy('show_order')->with('products:category_id,name,name_second,picture,video_id,price,description,description_second,video_url,currency_id')->get();

        return Utils::makeResponse([
            'category_array' => $categoryList
        ]);

    }

    public function getProductsByCategory()
    {
        $category_id = request('category_id');
        $search_keyword = request('search_keyword');
        $shown_count = request('shown_count');

        $where_clause = [];
        if ($search_keyword != "" && isset($search_keyword)) {
            $where_clause[] = ['name', 'like', "%$search_keyword%"];
            $where_clause[] = ['name_second', 'like', "%$search_keyword%"];
            $where_clause[] = ['description', 'like', "%$search_keyword%"];
            $where_clause[] = ['description_second', 'like', "%$search_keyword%"];
        }

        if (!isset($category_id)) {
            return Utils::makeResponse([], config('constants.response-message.invalid-params'));
        }

        $total_count = Products::where([
            ['category_id', $category_id],
            ['show_flag', 1]
        ])->where(function ($query) use ($where_clause) {
            if (count($where_clause) > 0) {
                $query->where([$where_clause[0]]);
                for ($i = 1; $i < count($where_clause); $i++) {
                    $query->orwhere([$where_clause[$i]]);
                }
            }
        })->count();

        $products = Products::where([
            ['category_id', $category_id],
            ['show_flag', 1]
        ])->where(function ($query) use ($where_clause) {
            if (count($where_clause) > 0) {
                $query->where([$where_clause[0]]);
                for ($i = 1; $i < count($where_clause); $i++) {
                    $query->orwhere([$where_clause[$i]]);
                }
            }
        })->offset($shown_count)->limit(12)->with('category', 'currency')->get();

        return Utils::makeResponse([
            'product_array' => $products,
            'total' => $total_count
        ]);

    }

    public function getProductDetail()
    {
        $product_id = request('product_id');
        if (!isset($product_id)) {
            return Utils::makeResponse([], config('constants.response-message.invalid-params'));
        }

        $product = Products::where([
            ['id', $product_id],
            ['show_flag', 1]
        ])->with('category', 'currency')->first();

        if ($product == null) {
            return Utils::makeResponse([], config('constants.response-message.invalid-params'));
        }

        return Utils::makeResponse([
            'product' => $product
        ]);

    }

    public function getClientDetail()
    {
        $client_email = request('email');
        if (!isset($client_email)) {
            return Utils::makeResponse([], config('constants.response-message.invalid-params'));
        }

        $client = Customers::select('id','password','first_name', 'last_name', 'email', 'template_no', 'category_background_color',
            'banner_color', 'font_color', 'product_background_color',f 'company_logo')
            ->where([
                ['email', $client_email],
                ['enable_flag', 1],
            ])->first();

        if ($client == null) {
            return Utils::makeResponse([], config('constants.response-message.invalid-params'));
        }

        $categoryList = Categories::select('id', 'name', 'name_second', 'rtl_direction')->where([
            ['customer_id', $client->id],
            ['show_flag', 1],
        ])->orderBy('show_order')->with(['products' => function($query) {
            $query->
            select('category_id','name','name_second','picture','video_id','price','description','description_second','video_url','currency_id')->
            where('show_flag', 1);
            ;
        }])->get();

        $client = $client->setHidden([
            'password'
        ]);

        return Utils::makeResponse([
            'client' => $client,
            'category_array' => $categoryList
        ]);

    }

}
