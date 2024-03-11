<?php

namespace App\Http\Controllers;
// use App\Models\Samsungphone;
// use App\Models\Applephone;
use App\Models\Product;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;

    public function samsung()
    {
        $samsungs = Product::where('category_id',1)->get();
        
        return response()->json($samsungs);
    }

    
    public function findproduct($id)
    {
        $product = Product::findOrFail($id);
        
        return response()->json($product);
    }


    public function apple()
    {
        $apples = Product::where('category_id',2)->get();
        
        return response()->json($apples);
    }
}
