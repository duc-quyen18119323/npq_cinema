@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Thanh toán vé</h2>
    <div class="card mb-3">
        <div class="card-body">
            <p><b>Mã vé:</b> {{ $booking->ticket_code }}</p>
            <p><b>Tên khách hàng:</b> {{ $booking->customer_name }}</p>
            <p><b>Số điện thoại:</b> {{ $booking->customer_phone }}</p>
            <p><b>Phim:</b> {{ $booking->showtime->movie->title ?? '' }}</p>
            <p><b>Suất chiếu:</b> {{ $booking->showtime->show_date ?? '' }} | {{ $booking->showtime->start_time ?? '' }} - {{ $booking->showtime->end_time ?? '' }}</p>
            <p><b>Ghế:</b>
                @if($booking->seats && $booking->seats->count())
                    @foreach($booking->seats as $seat)
                        <span class="badge bg-info text-dark">{{ $seat->seat_number }}</span>
                    @endforeach
                @else
                    {{ $booking->seat->seat_number ?? '' }}
                @endif
            </p>
            <hr>
            @php
                $accountNo = '9971790631';
                $bankId = 'VCB'; // Vietcombank
                $accountName = 'HO DUC QUYEN';
                $amount = $booking->seats && $booking->seats->count() ? $booking->seats->sum('price') : ($booking->seat->price ?? 0);
                $addInfo = $booking->ticket_code;
                $qrUrl = "https://img.vietqr.io/image/{$bankId}-{$accountNo}-compact2.png?amount={$amount}&addInfo={$addInfo}&accountName=" . urlencode($accountName);
            @endphp
            <div style="text-align:center; margin: 18px 0;">
                <img src="{{ $qrUrl }}" alt="QR chuyển khoản" style="max-width:220px;display:block;margin:auto;">
                <p class="text-center mt-2"><b>Quét QR để chuyển khoản nhanh</b></p>
            </div>
            <div class="alert alert-info mt-3">
                Vui lòng chuyển khoản đúng nội dung mã vé để hệ thống tự động xác nhận thanh toán!
            </div>
        </div>
    </div>
    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-secondary">Quay lại chi tiết vé</a>
</div>
@endsection
