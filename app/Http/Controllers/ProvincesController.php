<?php

namespace App\Http\Controllers;

use App\Models\Provinces;
use Illuminate\Http\Request;

class ProvincesController extends Controller
{
    /**
     * Display a listing of the resource for web.
     */
    public function index()
    {
        $provinces = Provinces::all();
        return view('provinces.index', compact('provinces'));
    }

    /**
     * Display a listing of the resource for API.
     */
    public function apiIndex()
    {
        $provinces = Provinces::all();
        return response()->json($provinces);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('provinces.create');
    }

    /**
     * Store a newly created resource in storage for web.
     */
    public function store(Request $request) {
        $request->validate(['name' => 'required|string|max:255']);
        Provinces::create(['name' => $request->name]);
        return redirect()->route('provinces.index')->with('success','Province added!');
    }

    /**
     * Store a newly created resource via API.
     */
    public function apiStore(Request $request) {
        $request->validate(['name' => 'required|string|max:255']);

        $province = Provinces::create(['name' => $request->name]);

        return response()->json([
            'message' => 'Province added successfully!',
            'province' => $province
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Provinces $province)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provinces $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provinces $province)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provinces $province)
    {
        //
    }
}
