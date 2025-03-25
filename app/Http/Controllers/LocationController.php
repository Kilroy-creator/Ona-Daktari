<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(){
        try {
            $locations = \App\Models\Location::all();
            if ($locations->isEmpty()) {
                return response()->json(["message" => "No locations found"], 404);
            }
            else {
                return response()->json($locations, 200);
            }
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }
    
    public function createLocation(Request $request){
        $validated = $request->validate([
            'name' => "required|string|max:255|unique:locations",
            "slug" => "required|string|max:255|unique:locations",
            'description' => "nullable|string|max:1000",
        ]);
        try{
            $location = \App\Models\Location::create($validated);
            if ($location) {
                return response()->json(["Created Location", $location], 201);
            }
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }
    
    public function getLocation($id){
        try {
            $location = \App\Models\Location::findOrFail($id);
            if ($location->count() > 0) {
                return response()->json($location, 200);
            } else {
                return response()->json(["message" => "Location not found"], 404);
            }
        } catch (\Exception $e) {
            return response()->json(["error" =>"Error Fetching Location `$id`"], 500);
        }
    }
    
    public function updateLocation(Request $request, $id){
        $validated = $request->validate([
            'name' => "required|string|max:255,|unique:locations,",
            "slug" => "required|string|max:255,|unique:locations,",
            'description' => "nullable|string|max:1000",
        ]);
        try{
            $location = \App\Models\Location::findOrFail($id);
            $location->update($validated);
            return response()->json(["message" => "Location Updated", $location], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }
    
    public function deleteLocation($id){
        try {
            $location = \App\Models\Location::findOrFail($id);
            $location->delete();
            return response()->json(["message" => "Location Deleted"], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }
}