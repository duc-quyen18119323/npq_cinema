@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Quản lý suất chiếu</h2>
    <a href="{{ route('admin.showtimes.create') }}" class="btn btn-primary">Thêm suất chiếu mới</a>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Phim</th>
            <th>Phòng</th>
            <th>Ngày chiếu</th>
            <th>Giờ bắt đầu</th>
            <th>Giờ kết thúc</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($showtimes as $showtime)
        <tr>
            <td>{{ $showtime->id }}</td>
            <td>{{ $showtime->movie->title ?? 'N/A' }}</td>
            <td>{{ $showtime->room->name ?? 'N/A' }}</td>
            <td>{{ $showtime->show_date }}</td>
            <td>{{ $showtime->start_time }}</td>
            <td>{{ $showtime->end_time }}</td>
            <td>
                <a href="{{ route('admin.showtimes.edit', $showtime->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('admin.showtimes.destroy', $showtime->id) }}" method="POST" style="display:inline-block">
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
    {{ $showtimes->links() }}
</div>
@endsection
