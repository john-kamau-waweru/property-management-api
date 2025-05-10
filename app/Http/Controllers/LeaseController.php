<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    // List all leases
    public function index()
    {
        $leases = Lease::with(['tenant', 'unit'])->paginate(10);
        return response()->json($leases);
    }

    // create a new lease
    public function store(Request $request){
        $data = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'tenant_id' => 'required|exists:tenants,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'rent_amount' => 'required|numeric|min:0',
            'status' => 'in:active,ended'
        ]);

        $lease = Lease::create($data);
        return response()->json($lease, 201);
    }

    // Show a single lease
    public function lease(Lease $lease){
        $lease->load(['tenant','unit']);
        return response()->json($lease);
    }

    // update a lease
    public function update(Request $request, Lease $lease){
        $data = $request->validate([
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after:start_date',
            'rent_amount' => 'sometimes|numeric|min:0',
            'status' => 'in:active,ended'
        ]);

        $lease->update($data);
        return response()->json($lease);
    }

    // Delete a lease
    public function destroy(Lease $lease)
    {
        $lease->delete();
        return response()->json(['message' => 'Lease deleted successfully']);
    }
}
