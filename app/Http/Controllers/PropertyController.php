<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    // Get paginated list of onlt the authenticated landlord's properties
    public function index(Request $request){
        /** @var \App\Models\User $user */
        $userId = auth()->user()->id;
        $query = Property::where('user_id', $userId);

        // filter by city
        if($request->has('city')){
            $query->where('city', $request->city);
        };

        // pagination
        $properties = $query->latest()->paginate(10);

        return response()->json($properties);
    }

    // Create a new property
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'city' => 'required|string'
        ]);

        $property = Property::create([
            ...$data,
            'user_id' => auth()->id(),
        ]);

        return response()->json($property, 201);
    }

    public function show(Property $property){
        $this->authorizeOwner($property);
        return response()->json($property);
    }

    public function update(Request $request, Property $property){
        $this->authorizeOwner($property);

        $data = $request->validate([
            'name' => 'sometimes|string',
            'city' => 'sometimes|string'
        ]);

        $property->update($data);

        return response()->json($property);
    }

    public function destroy(Property $property){
        $this->authorizeOwner($property);
        $property->delete();
        return response()->json(['message' => 'Property Deleted!']);
    }

    public function authorizeOwner(Property $property){
        if($property->user_id !== auth()->id()){
            abort(403, 'Unauthorized!');
        }
    }
}
