@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Quản lý ghế</h2>
    <a href="{{ route('admin.seats.create') }}" class="btn btn-primary">Thêm ghế mới</a>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Phòng</th>
            <th>Số ghế</th>
            <th>Loại</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($seats as $seat)
        <tr>
            <td>{{ $seat->id }}</td>
            <td>{{ $seat->room->name ?? 'N/A' }}</td>
            <td>{{ $seat->seat_number }}</td>
            <td>{{ $seat->type == 'vip' ? 'VIP' : 'Thường' }}</td>
            <td>
                <a href="{{ route('admin.seats.edit', $seat->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('admin.seats.destroy', $seat->id) }}" method="POST" style="display:inline-block">
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
