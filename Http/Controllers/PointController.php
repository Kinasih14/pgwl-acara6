<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Points;

class PointController extends Controller
{
    public function __construct()
    {
        $this->point = new Points();
    }
    /**
     * Display a listing of the resource. Buat function untuk menampilkan WKB ke GeoJSON
     */
    public function index()
    {
        $points = $this->point->points();

        foreach ($points as $p) {
            $feature[] = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom), //decode dari json ke php
                'properties' => [
                    'name' => $p->name,
                    'description' =>$p->description,
                    'created_at' =>$p->created_at,
                    'updated_at' =>$p->updated_at
                ]
                ];
        }

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $feature,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'name' => 'required',
            'geom' => 'required'
        ],
        [
            'name.required' => 'Name is required',
            'geom.required' => 'Location is required'
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'geom' => $request->geom
        ];
        //create point
        if(!$this->point->create($data)) {
            return redirect()->back()->with('error', 'Failed to create point');
        }
        //redirect to map
        return redirect()->back()->with('success', 'Point created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
