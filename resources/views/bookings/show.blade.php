@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Chi tiết vé đặt</h2>
    <div class="card mb-3">
        <div class="card-body">
            <p><b>Mã vé:</b> {{ $booking->ticket_code }}</p>
            <p><b>Phim:</b> {{ $booking->showtime->movie->title ?? '' }}</p>
            <p><b>Suất chiếu:</b> {{ $booking->showtime->show_date ?? '' }} | {{ $booking->showtime->start_time ?? '' }} - {{ $booking->showtime->end_time ?? '' }}</p>
            <p><b>Phòng:</b> {{ $booking->showtime->room->name ?? '' }}</p>
            <p><b>Ghế:</b>
                @if($booking->seats && $booking->seats->count())
                    @foreach($booking->seats as $seat)
                        <span class="badge bg-info text-dark">{{ $seat->seat_number }}</span>
                    @endforeach
                @else
                    {{ $booking->seat->seat_number ?? '' }}
                @endif
            </p>
            <p><b>Giá vé:</b>
                @if($booking->seats && $booking->seats->count())
                    {{ number_format($booking->seats->sum('price')) }} đ
                @else
                    {{ number_format($booking->seat->price ?? 0) }} đ
                @endif
            </p>
            <p><b>Tên khách hàng:</b> {{ $booking->customer_name }}</p>
            <p><b>Số điện thoại:</b> {{ $booking->customer_phone }}</p>
            <p><b>Trạng thái:</b> <span class="badge bg-{{ $booking->status == 'paid' ? 'success' : 'warning' }}">{{ $booking->status == 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}</span></p>
        </div>
    </div>
    <div class="d-flex gap-2">
        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn hủy vé này?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hủy vé</button>
        </form>
        <a href="{{ route('payments.create', ['booking_id' => $booking->id]) }}" class="btn btn-success">Thanh toán</a>
    </div>
</div>
@endsection
