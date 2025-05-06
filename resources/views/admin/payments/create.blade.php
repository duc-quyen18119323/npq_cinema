@extends('admin.layout')

@section('content')
<div class="col-md-8 offset-md-2">
    <h2>Thêm thanh toán mới</h2>
    <form action="{{ route('admin.payments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="booking_id" class="form-label">Đặt vé</label>
            <select name="booking_id" id="booking_id" class="form-control" required>
                <option value="">-- Chọn đặt vé --</option>
                @foreach($bookings as $booking)
                    <option value="{{ $booking->id }}">Mã: {{ $booking->id }} - {{ $booking->user->name ?? '' }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Số tiền</label>
            <input type="number" name="amount" id="amount" class="form-control" min="0" required>
        </div>
        <div class="mb-3">
            <label for="method" class="form-label">Phương thức</label>
            <select name="method" id="method" class="form-control" required>
                <option value="cash">Tiền mặt</option>
                <option value="banking">Chuyển khoản</option>
                <option value="momo">Momo</option>
                <option value="zalopay">ZaloPay</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="paid_at" class="form-label">Thời gian thanh toán</label>
            <input type="datetime-local" name="paid_at" id="paid_at" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
