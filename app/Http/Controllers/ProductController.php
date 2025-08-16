<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebProductRequest;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addproduct(WebProductRequest $request)
    {
        $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imagePaths[] = $file->store('products', 'public');
            }
        }

        $product = Products::create([
            'product_code' => 'PROD-' . strtoupper(uniqid()),
            'product_name' => $request->product_name,
            'product_sname' => $request->product_sname,
            'brand' => $request->brand,
            'Product_price' => $request->Product_price,
            'category' => $request->category,
            'weight' => $request->weight,
            'unit_of_measurement' => $request->unit_of_measurement,
            'stock' => $request->stock,
            'expiry_date' => $request->expiry_date,
            'Product_description' => $request->description, // Corrected field name
            'Product_image' => json_encode($imagePaths),
        ]);

        return response()->json(['message' => 'Product Added Successfully!', 'product' => $product], 201);
    }


    //getting products
    function getproduct()
    {
        $products = Products::all();
        return response()->json($products);
    }

    //Count
    public function getProductCount()
    {
        $countitems = Products::count();
        return response()->json(['count' => $countitems]);
    }


    //Unique Product
    public function show($id)
    {
        $product = Products::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json(['product' => $product]);
    }



    //delete
    function deleteproduct($id)
    {
        $products = Products::find($id);
        if ($products) {
            $products->delete();
            return response()->json(['message' => 'Product deleted successfully!']);
        }
        return response()->json(['message' => 'Product not found!'], 404);
    }


    public function updateproduct(Request $request, $id)
{
    $product = Products::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $request->validate([
        'product_name' => 'required',
        'Product_price' => 'required|numeric',
    ]);

    $product->update($request->all());

    return response()->json(['message' => 'Product updated successfully!', 'product' => $product]);
}
}


