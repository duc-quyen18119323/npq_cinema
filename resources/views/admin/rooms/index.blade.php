@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Quản lý phòng chiếu</h2>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">Thêm phòng mới</a>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên phòng</th>
            <th>Số ghế</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rooms as $room)
        <tr>
            <td>{{ $room->id }}</td>
            <td>{{ $room->name }}</td>
            <td>{{ $room->total_seats }}</td>
            <td>
                <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" style="display:inline-block">
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
