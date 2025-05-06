@extends('admin.layout')

@section('content')
<div class="col-md-6 offset-md-3">
    <h2>Sửa ghế: {{ $seat->seat_number }}</h2>
    <form action="{{ route('admin.seats.update', $seat->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="room_id" class="form-label">Phòng</label>
            <select name="room_id" id="room_id" class="form-control" required>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ $seat->room_id == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="seat_number" class="form-label">Số ghế</label>
            <input type="text" name="seat_number" id="seat_number" class="form-control" value="{{ $seat->seat_number }}" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Loại ghế</label>
            <select name="type" id="type" class="form-control">
                <option value="regular" {{ $seat->type == 'regular' ? 'selected' : '' }}>Thường</option>
                <option value="vip" {{ $seat->type == 'vip' ? 'selected' : '' }}>VIP</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.seats.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
