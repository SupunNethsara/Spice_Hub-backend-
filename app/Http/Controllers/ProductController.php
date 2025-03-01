<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function addproduct(Request $request){
        $request->validate([
            'product_name' => 'required|string|max:255',
            'Product_price' => 'required|numeric',
            'Product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Product_description' => 'required|string',
        ]);
        if ($request->hasFile('Product_image')) {
            $imageName = time().'.'.$request->Product_image->extension();
            $request->Product_image->storeAs('public/products', $imageName);
            $imagePath = 'products/' . $imageName;
        } else {
            $imagePath = null;
        }
        Products::create([
            'product_name' => $request->product_name,
            'Product_price' => $request->Product_price,
            'Product_image' => $imagePath,
            'Product_description' => $request->Product_description,
        ]);
        return response()->json(['message' => 'Product added successfully'], 201);
    }
}
