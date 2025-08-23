<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\Provinces;
use App\Models\ShippingPayments;
use Illuminate\Http\Request;

class ShipingPaymentsController extends Controller
{
    /**
     * Display a listing of the resource for web.
     */
    public function index() {
        $payments = ShippingPayments::with('province','district')->get();
        return view('shipping_payments.index', compact('payments'));
    }

    /**
     * Display a listing of the resource for API.
     */
    public function apiIndex() {
        $payments = ShippingPayments::with('province','district')->get();
        return response()->json($payments);
    }

    // Show create form for web
    public function create() {
        $provinces = Provinces::all();
        $districts = Districts::all();
        return view('shipping_payments.create', compact('provinces','districts'));
    }

    // Store new shipping payment for web
    public function store(Request $request) {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'amount' => 'required|numeric|min:0'
        ]);

        ShippingPayments::create([
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'amount' => $request->amount
        ]);

        return redirect()->route('shipping_payments.index')->with('success','Shipping Payment added!');
    }

    // Store new shipping payment via API
    public function apiStore(Request $request) {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'amount' => 'required|numeric|min:0'
        ]);

        $payment = ShippingPayments::create([
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'amount' => $request->amount
        ]);

        return response()->json([
            'message' => 'Shipping Payment added successfully!',
            'payment' => $payment->load(['province', 'district'])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShippingPayments $shippingPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingPayments $shippingPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShippingPayments $shippingPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingPayments $shippingPayment)
    {
        //
    }
}
