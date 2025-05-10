<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    // get all tenants
    public function index(){
        return response()->json(Tenant::all());
    }

    public function store(Request $request){
        // validate
        $request->validate([
            'first_name' => "required|string|max:255",
            'last_name' => "required|string|max:255",
            'email' => "required|email|unique:tenants,email",
            'phone' => "nullable|string|max:15",
        ]);

        //create a newtenant
        $tenant = Tenant::create($request->all());

        return response()->json($tenant,201);
    }

    public function show($id){
        $tenant = Tenant::findOrFail($id);

        return response()->json($tenant);
    }

    public function update(Request $request, $id){
        $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:tenants,email',
            'phone' => 'sometimes|string|max:15'
        ]);
        
        // Find tenant and update their details
        $tenant = Tenant::findOrFail($id);
        $tenant->update($request->all());

        return response()->json($tenant);
    }

    public function destroy($id){
        Tenant::destroy($id);

        return response()->json(null, 204);
    }
}
