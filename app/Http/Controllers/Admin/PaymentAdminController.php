<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = \App\Models\Payment::with('booking.user')->get();
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookings = \App\Models\Booking::with('user')->get();
        return view('admin.payments.create', compact('bookings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required',
            'paid_at' => 'required|date',
        ]);
        \App\Models\Payment::create($data);
        return redirect()->route('admin.payments.index')->with('success', 'Thêm thanh toán thành công!');
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
    public function edit($id)
    {
        $payment = \App\Models\Payment::findOrFail($id);
        $bookings = \App\Models\Booking::with('user')->get();
        return view('admin.payments.edit', compact('payment', 'bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $payment = \App\Models\Payment::findOrFail($id);
        $data = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required',
            'paid_at' => 'required|date',
        ]);
        $payment->update($data);
        return redirect()->route('admin.payments.index')->with('success', 'Cập nhật thanh toán thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $payment = \App\Models\Payment::findOrFail($id);
        $payment->delete();
        return redirect()->route('admin.payments.index')->with('success', 'Xóa thanh toán thành công!');
    }
}
