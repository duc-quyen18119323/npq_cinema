@extends('admin.layout')

@section('content')
<div class="col-md-8 offset-md-2">
    <h2>Sửa thanh toán</h2>
    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="booking_id" class="form-label">Đặt vé</label>
            <select name="booking_id" id="booking_id" class="form-control" required>
                @foreach($bookings as $booking)
                    <option value="{{ $booking->id }}" {{ $payment->booking_id == $booking->id ? 'selected' : '' }}>Mã: {{ $booking->id }} - {{ $booking->user->name ?? '' }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Số tiền</label>
            <input type="number" name="amount" id="amount" class="form-control" min="0" value="{{ $payment->amount }}" required>
        </div>
        <div class="mb-3">
            <label for="method" class="form-label">Phương thức</label>
            <select name="method" id="method" class="form-control" required>
                <option value="cash" {{ $payment->method == 'cash' ? 'selected' : '' }}>Tiền mặt</option>
                <option value="banking" {{ $payment->method == 'banking' ? 'selected' : '' }}>Chuyển khoản</option>
                <option value="momo" {{ $payment->method == 'momo' ? 'selected' : '' }}>Momo</option>
                <option value="zalopay" {{ $payment->method == 'zalopay' ? 'selected' : '' }}>ZaloPay</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="paid_at" class="form-label">Thời gian thanh toán</label>
            <input type="datetime-local" name="paid_at" id="paid_at" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($payment->paid_at)) }}" required>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
