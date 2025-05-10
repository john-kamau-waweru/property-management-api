<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        return Payment::with('lease')->paginate(10);
    }

    // store a new payment
    public function store(Request $request){
        $data = $request->validate([
            'lease_id' => 'required|exists:leases,id',
            'amount' => 'required|numeric|min:0',
            'due_date' => "required|date",
            'paid_date' => 'nullable|date',
            'status' => 'required|in:paid,due,late'
        ]);

        $payment = Payment::create($data);

        return response()->json($payment, 201);
    }

    // single payment
    public function show(Payment $payment){
        return $payment->load('lease');
    }

    // Update payment
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'amount' => 'sometimes|numeric|min:0',
            'due_date' => 'sometimes|date',
            'paid_date' => 'nullable|date',
            'status' => 'sometimes|in:paid,due,late',
        ]);

        $payment->update($validated);

        return response()->json($payment);
    }

    // Delete payment
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(null, 204);
    }
}
