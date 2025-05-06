<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Payment::with(['booking'])->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $bookingId = $request->query('booking_id');
        $booking = \App\Models\Booking::findOrFail($bookingId);
        return view('payments.create', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required',
            'payment_time' => 'nullable|date',
            'status' => 'required|in:pending,completed,failed',
        ]);
        $payment = Payment::create($data);
        return response()->json($payment->load(['booking']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return response()->json($payment->load(['booking']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return response(null, 204);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required',
            'payment_time' => 'nullable|date',
            'status' => 'required|in:pending,completed,failed',
        ]);
        $payment->update($data);
        return response()->json($payment->load(['booking']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
