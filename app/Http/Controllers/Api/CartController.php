<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {    
        //checking if user with same product id exist ,if there quantity is changing 
       if(Cart::where('user_id',$request->input('user-id'))->where('product_id',$request->input('product-id'))->first()){
          $cart = Cart::where('user_id',$request->input('user-id'))->where('product_id',$request->input('product-id'))->first();
          $cart->quantity += $request->input('quantity');
          $cart->save();
          return response()->json('Added To Cart');
       }else{
          
        $cart = new Cart;

            $cart->user_id = $request->input('user-id');
            $cart->product_id = $request->input('product-id');
            $cart->quantity = $request->input('quantity');
            // $cart->total = $request->input('price');
            $cart->save();
            
            return response()->json('Added To Cart');
       }
            

    }

    public function findItemsInCart($userId)
    {
        
        $productsIds = Cart::where('user_id',$userId)->get('product_id')->toArray();
        $values = collect($productsIds)->flatten()->toArray();  //converting nested array to array
        $items=[];

        foreach($values as $value){
            
            $items = Product::whereIn('id',$values)->get();  //->toArray()
        }
    
        // dd($items);                            
        // $products = Cart::where('user_id',$userId)->get();
        return response()->json($items);
    }


    public function delete($product_id,$user_id)
    {
        // dd($product_id,$user_id);
      $item = Cart::where('user_id',$user_id)->where('product_id',$product_id)->first();
    //   $item = Cart::findOrFail($user_id);
     
      $item->delete();
      return response()->json('deleted');
    }
}
