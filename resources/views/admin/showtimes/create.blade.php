@extends('admin.layout')

@section('content')
<div class="col-md-8 offset-md-2">
    <h2>Thêm suất chiếu mới</h2>
    <form action="{{ route('admin.showtimes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="movie_id" class="form-label">Phim</label>
            <select name="movie_id" id="movie_id" class="form-control" required>
                <option value="">-- Chọn phim --</option>
                @foreach($movies as $movie)
                    <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="room_id" class="form-label">Phòng</label>
            <select name="room_id" id="room_id" class="form-control" required>
                <option value="">-- Chọn phòng --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="show_date" class="form-label">Ngày chiếu</label>
            <input type="date" name="show_date" id="show_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="start_time" class="form-label">Giờ bắt đầu</label>
            <input type="time" name="start_time" id="start_time" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="end_time" class="form-label">Giờ kết thúc</label>
            <input type="time" name="end_time" id="end_time" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.showtimes.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
