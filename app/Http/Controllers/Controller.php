<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dash()
    {

        $categories = Category::all();
        $products = Product::query()
            ->orderBy('id', 'desc')
            ->get();
        ;

       //get name of category and product


        $users = User::all();
        $carts = Cart::all();




        return view('admin.dashboard.index', compact('categories', 'products', 'users', 'carts'));
    }
   
    public function filterByCategory($category)
    {
        $products = Product::query();
        if($category != null){
            $products = $products->where('category_id', $category);
        }
        $categories = Category::all();
        $result = $products->get();
       //get products all products in database
       return view('welcome', ['products' => $result, 'categories' =>  $categories]);
    }
    public function index(){
        $products = Product::query();
        $categories = Category::all();
        $result = $products->get();
       //get products all products in database
       return view('welcome', ['products' => $result, 'categories' =>  $categories]);
    }
    public function response($finally_code){
    
       return view('/reponse', ['finally_code' => $finally_code]);
    }

    public function show($id){
        //get product by id
        $product = Product::find($id);
        return view('products.OneProduct', ['product' => $product]);
    }

    public function neryShow($id){
        $Cart = Cart::where('user_id', $id)->get();
        $Total = 0;
        $UserId = $Cart[0]->user_id;
    
        $Products = [];
        foreach($Cart as $item){
            $product = Product::where('id', $item->product_id)->first();
            $prepare = [
                'id' => $product->id,
                'cart_id' => $item->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'category_id' => $product->category_id,
                'short_description' => $product->short_description,
                'long_description' => $product->long_description,
                'rate' => $product->rate,
                'imageSrc' => $product->imageSrc,
                'imageAlt' => $product->imageAlt,
                'href' => $product->href,
                'brand' => $product->brand,
                
            ];
            array_push($Products, $prepare);
            $Total += $product->price;
        }

        $User = User::where('id', $UserId)->first();
        return view('admin.cart.index', ['User'=>$User, 'Products' => $Products, 'Total' => $Total, 'Code' => $UserId]);
    } 
}
