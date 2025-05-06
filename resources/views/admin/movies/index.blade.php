@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Quản lý phim</h2>
    <a href="{{ route('admin.movies.create') }}" class="btn btn-primary">Thêm phim mới</a>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Thời lượng</th>
            <th>Trạng thái</th>
            <th>Poster</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($movies as $movie)
        <tr>
            <td>{{ $movie->id }}</td>
            <td>{{ $movie->title }}</td>
            <td>{{ $movie->duration }} phút</td>
            <td>{{ $movie->status == 'now_showing' ? 'Đang chiếu' : 'Sắp chiếu' }}</td>
            <td>
                @if($movie->poster)
                    <img src="{{ asset('storage/posters/' . $movie->poster) }}" alt="Poster" width="60">
                @endif
            </td>
            <td>
                <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" style="display:inline-block">
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
    {{ $movies->links('pagination::bootstrap-4') }}
</div>
@endsection
