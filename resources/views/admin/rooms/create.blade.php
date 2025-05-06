@extends('admin.layout')

@section('content')
<div class="col-md-6 offset-md-3">
    <h2>Thêm phòng chiếu mới</h2>
    <form action="{{ route('admin.rooms.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên phòng</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="total_seats" class="form-label">Số ghế</label>
            <input type="number" name="total_seats" id="total_seats" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
