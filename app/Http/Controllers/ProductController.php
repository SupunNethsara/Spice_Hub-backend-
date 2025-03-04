<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addproduct(Request $request)
    {
        // Validate incoming request, including 'category'
        $request->validate([
            'product_name' => 'required',
            'product_sname' => 'required',
            'brand' => 'required',
            'Product_price' => 'required|numeric',
            'category' => 'required|string', // Added validation for category
            'weight' => 'required|numeric',
            'unit_of_measurement' => 'required',
            'stock' => 'required|integer',
            'expiry_date' => 'required|date',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Save the product with the added category field
        $product = Products::create([
            'product_code' => 'PROD-' . strtoupper(uniqid()), // Generate a unique code
            'product_name' => $request->product_name, // Corrected field name
            'product_sname' => $request->product_sname, // Corrected field name
            'brand' => $request->brand,
            'Product_price' => $request->Product_price, // Corrected field name
            'category' => $request->category, // Added category
            'weight' => $request->weight,
            'unit_of_measurement' => $request->unit_of_measurement,
            'stock' => $request->stock,
            'expiry_date' => $request->expiry_date,
            'Product_description' => $request->description, // Corrected field name
            'Product_image' => $imagePath, // Corrected field name
        ]);

        return response()->json(['message' => 'Product Added Successfully!', 'product' => $product], 201);
    }



    function getproduct() {
        $products = Products::all();
        return response()->json($products);
    }
}
