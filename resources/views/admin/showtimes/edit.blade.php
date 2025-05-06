@extends('admin.layout')

@section('content')
<div class="col-md-8 offset-md-2">
    <h2>Sửa suất chiếu</h2>
    <form action="{{ route('admin.showtimes.update', $showtime->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="movie_id" class="form-label">Phim</label>
            <select name="movie_id" id="movie_id" class="form-control" required>
                @foreach($movies as $movie)
                    <option value="{{ $movie->id }}" {{ $showtime->movie_id == $movie->id ? 'selected' : '' }}>{{ $movie->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="room_id" class="form-label">Phòng</label>
            <select name="room_id" id="room_id" class="form-control" required>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ $showtime->room_id == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="show_date" class="form-label">Ngày chiếu</label>
            <input type="date" name="show_date" id="show_date" class="form-control" value="{{ $showtime->show_date }}" required>
        </div>
        <div class="mb-3">
            <label for="start_time" class="form-label">Giờ bắt đầu</label>
            <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $showtime->start_time }}" required>
        </div>
        <div class="mb-3">
            <label for="end_time" class="form-label">Giờ kết thúc</label>
            <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $showtime->end_time }}" required>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.showtimes.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
