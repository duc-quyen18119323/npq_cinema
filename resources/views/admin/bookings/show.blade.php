@extends('admin.layout')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Chi tiết vé</h3>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 200px">Mã vé:</th>
                    <td>{{ $booking->ticket_code }}</td>
                </tr>
                <tr>
                    <th>Người đặt:</th>
                    <td>
                        @if($booking->user)
                            {{ $booking->user->email }}
                        @else
                            {{ $booking->customer_name }} ({{ $booking->customer_phone }})
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Phim:</th>
                    <td>{{ $booking->showtime->movie->title }}</td>
                </tr>
                <tr>
                    <th>Suất chiếu:</th>
                    <td>{{ $booking->showtime->show_date }} {{ $booking->showtime->start_time }}</td>
                </tr>
                <tr>
                    <th>Phòng:</th>
                    <td>{{ $booking->showtime->room->name }}</td>
                </tr>
                <tr>
                    <th>Ghế:</th>
                    <td>{{ $booking->seat->seat_number }}</td>
                </tr>
                <tr>
                    <th>Giá vé:</th>
                    <td>{{ number_format($booking->seat->price) }} VNĐ</td>
                </tr>
                <tr>
                    <th>Trạng thái:</th>
                    <td>
                        @if($booking->status == 'paid')
                            <span class="badge bg-success">Đã thanh toán</span>
                        @else
                            <span class="badge bg-warning">Chưa thanh toán</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Thời gian đặt:</th>
                    <td>{{ $booking->created_at }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
