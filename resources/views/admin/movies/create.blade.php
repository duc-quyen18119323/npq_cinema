@extends('admin.layout')

@section('content')
<div class="col-md-8 offset-md-2">
    <h2>Thêm phim mới</h2>
    <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="trailer_url" class="form-label">Trailer (URL)</label>
            <input type="url" name="trailer_url" id="trailer_url" class="form-control">
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Thời lượng (phút)</label>
            <input type="number" name="duration" id="duration" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label for="poster" class="form-label">Poster (file ảnh)</label>
            <input type="file" name="poster" id="poster" class="form-control">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" id="status" class="form-control">
                <option value="now_showing">Đang chiếu</option>
                <option value="coming_soon">Sắp chiếu</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
