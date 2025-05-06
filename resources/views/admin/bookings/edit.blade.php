@extends('admin.layout')

@section('content')
<div class="col-md-8 offset-md-2">
    <h2>Sửa đặt vé</h2>
    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="user_id" class="form-label">Khách hàng</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $booking->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="showtime_id" class="form-label">Suất chiếu</label>
            <select name="showtime_id" id="showtime_id" class="form-control" required>
                @foreach($showtimes as $showtime)
                    <option value="{{ $showtime->id }}" {{ $booking->showtime_id == $showtime->id ? 'selected' : '' }}>{{ $showtime->movie->title ?? '' }} - {{ $showtime->show_date }} {{ $showtime->start_time }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="seat_id" class="form-label">Ghế</label>
            <select name="seat_id" id="seat_id" class="form-control" required>
                @foreach($seats as $seat)
                    <option value="{{ $seat->id }}" {{ $booking->seat_id == $seat->id ? 'selected' : '' }}>{{ $seat->room->name ?? '' }} - {{ $seat->seat_number }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" id="status" class="form-control">
                <option value="unpaid" {{ $booking->status == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                <option value="paid" {{ $booking->status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
