@extends('admin.layout')

@section('content')
<div class="col-md-6 offset-md-3">
    <h2>Sửa phòng: {{ $room->name }}</h2>
    <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tên phòng</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $room->name }}" required>
        </div>
        <div class="mb-3">
            <label for="total_seats" class="form-label">Số ghế</label>
            <input type="number" name="total_seats" id="total_seats" class="form-control" min="1" value="{{ $room->total_seats }}" required>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
