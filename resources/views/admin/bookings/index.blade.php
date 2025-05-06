@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Quản lý đặt vé</h2>
</div>
<form method="GET" action="{{ route('admin.bookings.index') }}" class="mb-3">
    <div class="input-group" style="max-width: 300px;">
        <input type="text" name="email" class="form-control" placeholder="Tìm theo email khách hàng..." value="{{ request('email') }}">
        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
    </div>
</form>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Mã vé</th>
            <th>Khách hàng</th>
            <th>Suất chiếu</th>
            <th>Trạng thái</th>
            <th>Thời gian đặt</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td>{{ $booking->id }}</td>
            <td>{{ $booking->ticket_code }}</td>
            <td>
    @if($booking->user)
        {{ $booking->user->email }}
    @elseif($booking->customer_name)
        {{ $booking->customer_name }}
    @else
        N/A
    @endif
</td>
            <td>{{ $booking->showtime->movie->title ?? '' }}<br>{{ $booking->showtime->show_date ?? '' }} {{ $booking->showtime->start_time ?? '' }}</td>
            <td>{{ $booking->status == 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}</td>
            <td>{{ $booking->created_at }}</td>
            <td>
                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">Chi tiết</a>
                <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                @if($booking->status == 'unpaid')
                    <form action="{{ route('admin.bookings.confirm-payment', $booking->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Xác nhận thanh toán cho đặt vé này?')">Xác nhận</button>
                    </form>
                @endif
                <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center mt-3">
    {{ $bookings->links() }}
</div>
@endsection
