<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\Provinces;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource for web.
     */
    public function index() {
        $districts = Districts::with('province')->get();
        return view('districts.index', compact('districts'));
    }

    /**
     * Display a listing of the resource for API.
     */
    public function apiIndex() {
        $districts = Districts::with('province')->get();
        return response()->json($districts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $provinces = Provinces::all();
        return view('districts.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage for web.
     */
    public function store(Request $request) {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255'
        ]);

        Districts::create([
            'province_id' => $request->province_id,
            'name' => $request->name
        ]);

        return redirect()->route('districts.index')->with('success','District added!');
    }

    /**
     * Store a newly created resource via API.
     */
    public function apiStore(Request $request) {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255'
        ]);

        $district = Districts::create([
            'province_id' => $request->province_id,
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'District added successfully!',
            'district' => $district->load('province')
        ], 201);
    }

    public function getByProvince($provinceId) {
        $districts = Districts::where('province_id', $provinceId)->get();
        return response()->json($districts);
    }

    /**
     * Display the specified resource.
     */
    public function show(Districts $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Districts $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Districts $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Districts$district)
    {
        //
    }
}
