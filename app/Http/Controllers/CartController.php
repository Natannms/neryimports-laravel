<?php

namespace App\Http\Controllers;

use App\Http\Utils\SendMessage;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductList;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createCart( Request $request)
    { 
        //clear all sessions
        $cart = $request->session()->get('cart');
        //cart is null
        if(!$cart){
            $product = Product::find($request->id);
            $cart = new Cart();
            $cart->user_id = null;
            $cart->quantity = $request->quantity;
            $cart->product_id =  $product->id;
            $cart->save();

            $request->session()->put('cart', $cart->id);
            $cartQuantity = $request->session()->get('cartQuantity');
            //cart is null
            if($cartQuantity){
                $totalCartQuantity = $cartQuantity + $request->quantity;
                $request->session()->put('cartQuantity', $totalCartQuantity);
            }else{
                $request->session()->put('cartQuantity', $request->quantity);
            }
            //insert new proct in to product_lists table
            $productList = new ProductList();
            $productList->product_id = $request->id;
            $productList->cart_id = $cart->id;
            $productList->quantity = $request->quantity;
            $productList->save();
        }else{
            //insert new proct in to product_lists table
            $productList = new ProductList();
            $productList->product_id = $request->id;
            $productList->cart_id = $cart;
            $productList->quantity = $request->quantity;
            $productList->save();
            $request->session()->put('cart', $cart);

            $cartQuantity = $request->session()->get('cartQuantity');
            //cart is null
            if($cartQuantity){
                //convert variable in to float
                $totalCartQuantity = $cartQuantity + $request->quantity;
                $request->session()->put('cartQuantity', $totalCartQuantity);
            }else{
                $request->session()->put('cartQuantity', $request->quantity);
            }
        }

        if($request->continueInShop == 'continue'){
            //redirect to home
            return redirect()->route('home');
        }

        if($request->continueInShop == 'cart'){
            
            return redirect()->route('mycart');
        }
    }

    public function store(Request $request){
        
        //get user by email
        $User = User::where('email', $request->email)->first();

        //if dont exist create new user
        if(!$User){
            $user = new User();
            $user->name = '';
            $user->email = $request->email;
            $user->password = '000000';
            $user->save();

            $User = $user;
        }
       
        //explode cart
        $cart = explode(',', $request->cart);

        //for each product in cart insert into cart
        foreach($cart as $product){
            $FindProduct = Product::find($product);

            $NewCart = new Cart();
            $NewCart->product_id = $FindProduct->id;
            $NewCart->quantity = 1;
            $NewCart->user_id = $User->id;
            $NewCart->email = $request->email;
            $NewCart->save();
        
        }
        
        return redirect()->route('mycart', ['id' => $User->id, 'email' => $request->email, 'address' => $request->address, 'phone' => $request->phone]);
 }
    public function finally(Request $request){
        //get cart in session
        $cart = $request->session()->get('cart');
        //get cart
        $cart = Cart::where('id', $cart)->get();
        $productList = ProductList::where('cart_id', $cart[0]->id)->get();
        $List = [];
        $total = 0;
        
        foreach ($productList as $key => $item) {
            $product = Product::find($item['product_id']);
            $List[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $item['quantity'],
                'total' => $product->price * $item['quantity']
            ];
        }
        foreach($List as $product){
            $total += $product['total'];
        }           
        
        //  SendMessage::sendByWebSocket($List, $total, [$request->phone, $request->name, $request->email]);
        
            return SendMessage::OrderFromWhatsapp($List, $total, [$request->phone, $request->name, $request->email]);
            // SendMessage::sendMailBySendGrid($List, $total, [$request->phone, $request->name, $request->email]);
        //  return view('responses.final', ['finally_code' => $User->id]);
 }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function prepareBag(Request $request){

    }  
      // return view('cart.index', ['Total'=>$total, 'totalMonetary'=>$totalNumberFormat, 'Products' =>$products, 'Code'=>$cart->id]);
   public function toCart(Request $request)
   {    
        $cartId =  $request->session()->get('cart');
        if($cartId){
            $Productlist = ProductList::select('product_lists.id AS List_id', 
            'product_lists.quantity', 'product_lists.product_id', 'products.name', 'products.price',
            'products.image', 'products.id AS product_id', 'products.short_description','products.long_description', 'products.category_id', 
             'products.brand', 'products.imageSrc', 'products.imageAlt'

            )
            ->where('cart_id', $cartId)
            ->join( 'products', 'products.id', '=', 'product_lists.product_id')
            ->get();
            $totalSize = count($Productlist);
            $total = 0;
            foreach($Productlist as $product){
                $total += $product->price * $product->quantity;
            }
            // return $Productlist;
            return view( 'cart.index', ['Products' => $Productlist, 'totalSize' => $totalSize, 'Total' => $total]);
        }
   }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id){
        //
    }

    public function removeItemCart($id, Request $request)
    {
        //clear all sessions
       
        $Productlist = ProductList::find($id);
        $Productlist->delete();
        $Productlist =  ProductList::all();

        if(count($Productlist) <=0){
             $request->session()->put('response', 'Seu carrinho está vazio');
        }
        return redirect()->route('mycart');
    }
}
