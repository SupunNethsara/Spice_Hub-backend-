<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\OrderProducts;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function StoreProduct(OrderRequest $request)
    {
        $request->validated();
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('OrderProducts', 'public');
        }
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imagePaths[] = $file->store('OrderProducts', 'public');
            }
        }
        $orderProduct = OrderProducts::create([
            'product_name' => $request->product_name,
            'product_sname' => $request->product_sname,
            'brand' => $request->brand,
            'Product_price' => $request->Product_price,
            'category' => $request->category,
            'weight' => $request->weight,
            'unit_of_measurement' => $request->unit_of_measurement,
            'stock' => $request->stock,
            'expiry_date' => $request->expiry_date,
            'Product_description' => $request->description,
            'Product_image' => json_encode($imagePaths),
        ]);

        return response()->json(['message' => 'Product Added Successfully!', 'OrderProduct' => $orderProduct], 201);
    }
    public function getOrderProduct()
    {
        $orderProducts = OrderProducts::all();
        return response()->json($orderProducts);
    }
    public function getCount()
    {
        $countitems = OrderProducts::count();
        return response()->json(['count' => $countitems]);
    }
}
