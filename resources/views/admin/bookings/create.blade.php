@extends('admin.layout')

@section('content')
<div class="col-md-8 offset-md-2">
    <h2>Thêm đặt vé mới</h2>
    <form action="{{ route('admin.bookings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Khách hàng</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Chọn khách hàng --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="showtime_id" class="form-label">Suất chiếu</label>
            <select name="showtime_id" id="showtime_id" class="form-control" required>
                <option value="">-- Chọn suất chiếu --</option>
                @foreach($showtimes as $showtime)
                    <option value="{{ $showtime->id }}">{{ $showtime->movie->title ?? '' }} - {{ $showtime->show_date }} {{ $showtime->start_time }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="seat_id" class="form-label">Ghế</label>
            <select name="seat_id" id="seat_id" class="form-control" required>
                <option value="">-- Chọn ghế --</option>
                @foreach($seats as $seat)
                    <option value="{{ $seat->id }}">{{ $seat->room->name ?? '' }} - {{ $seat->seat_number }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" id="status" class="form-control">
                <option value="unpaid">Chưa thanh toán</option>
                <option value="paid">Đã thanh toán</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
