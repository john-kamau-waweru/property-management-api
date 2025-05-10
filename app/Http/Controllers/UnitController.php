<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    // create a new unit
    public function store(Request $request, $propertyId){

        $request->validate([
            'name' => 'required|string|max:255',
            'rent_amount' => 'required|numeric|min:0'
        ]);

        $property = Property::findOrFail($propertyId);

        $unit = Unit::create([
            'property_id' => $propertyId,
            'name' => $request->name,
            'rent_amount' =>$request->rent_amount
        ]);

        return response()->json($unit, 201);
    }

    // Update a unit
    public function update(Request $request, $id){
        $unit = Unit::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'rent_amount' => 'sometimes|numeric|min:0'
        ]);

        $unit->update($request->only(['name', 'rent_amount']));

        return response()->json($unit, 200);
    }

    // Get all units for a property
    public function index($propertyId){
        $property = Property::findOrFail($propertyId);
        return response()->json($property->units, 200);
    }

    // Delete a unit
    public function destroy($id){
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return response()->json(['message' => 'Unit deleted successfully'], 200);
    }
}
