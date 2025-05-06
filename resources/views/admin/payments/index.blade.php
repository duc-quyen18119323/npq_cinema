@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Quản lý thanh toán</h2>
    <a href="{{ route('admin.payments.create') }}" class="btn btn-primary">Thêm thanh toán mới</a>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Đặt vé</th>
            <th>Số tiền</th>
            <th>Phương thức</th>
            <th>Thời gian thanh toán</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->id }}</td>
            <td>Mã: {{ $payment->booking->id ?? '' }}<br>Khách: {{ $payment->booking->user->name ?? '' }}</td>
            <td>{{ number_format($payment->amount) }} đ</td>
            <td>{{ $payment->method }}</td>
            <td>{{ $payment->paid_at }}</td>
            <td>
                <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
