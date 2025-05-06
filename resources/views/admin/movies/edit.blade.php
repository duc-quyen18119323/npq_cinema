@extends('admin.layout')

@section('content')
<div class="col-md-8 offset-md-2">
    <h2>Sửa phim: {{ $movie->title }}</h2>
    <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $movie->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ $movie->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="trailer_url" class="form-label">Trailer (URL)</label>
            <input type="url" name="trailer_url" id="trailer_url" class="form-control" value="{{ $movie->trailer_url }}">
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Thời lượng (phút)</label>
            <input type="number" name="duration" id="duration" class="form-control" min="1" value="{{ $movie->duration }}" required>
        </div>
        <div class="mb-3">
            <label for="poster" class="form-label">Poster (file ảnh)</label>
            <input type="file" name="poster" id="poster" class="form-control">
            @if($movie->poster)
                <img src="{{ asset('storage/posters/' . $movie->poster) }}" alt="Poster" width="80" class="mt-2">
            @endif
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" id="status" class="form-control">
                <option value="now_showing" {{ $movie->status == 'now_showing' ? 'selected' : '' }}>Đang chiếu</option>
                <option value="coming_soon" {{ $movie->status == 'coming_soon' ? 'selected' : '' }}>Sắp chiếu</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
