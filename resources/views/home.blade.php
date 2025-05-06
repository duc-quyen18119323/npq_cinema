@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="text-center bg-dark text-white rounded p-4 mb-3">
            <h1 class="display-5">Chào mừng đến với NPQ Cinema</h1>
            <p class="lead">Đặt vé xem phim trực tuyến, cập nhật lịch chiếu mới nhất, lựa chọn chỗ ngồi yêu thích!</p>
        </div>
    </div>
</div>

<div class="row">
    <h2 class="mb-3">Phim đang chiếu</h2>
    @if($nowShowing->count())
        @foreach($nowShowing as $movie)
        <div class="col-md-3 mb-4">
            <div class="card h-100 movie-card position-relative" style="overflow:hidden">
                @if($movie->poster)
                    @if(Str::startsWith($movie->poster, 'http'))
                        <img src="{{ $movie->poster }}" class="card-img-top movie-poster" alt="{{ $movie->title }}" style="width:100%;height:340px;object-fit:cover;">
                    @else
                        <img src="{{ asset('storage/posters/' . $movie->poster) }}" class="card-img-top movie-poster" alt="{{ $movie->title }}" style="width:100%;height:340px;object-fit:cover;">
                    @endif
                @else
                    <img src="https://via.placeholder.com/220x340?text=No+Poster" class="card-img-top movie-poster" alt="No poster" style="width:100%;height:340px;object-fit:cover;">
                @endif
                <div class="movie-overlay d-flex flex-column justify-content-center align-items-center">
                    @if($movie->trailer_url)
                        <button class="btn btn-outline-light btn-trailer mt-2" data-trailer="{{ $movie->trailer_url }}">Xem trailer</button>
                    @endif
                    <button class="btn btn-primary btn-book mt-2" data-movie="{{ $movie->id }}">Đặt vé</button>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $movie->title }}</h5>
                    <p class="card-text">{{ Str::limit($movie->description, 80) }}</p>
                    <span class="badge bg-success">{{ $movie->duration }} phút</span>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="col-12 text-center">
            <p>Hiện chưa có phim nào đang chiếu.</p>
        </div>
    @endif
</div>

<div class="row mt-5">
    <h2 class="mb-3">Phim sắp chiếu</h2>
    @if($comingSoon->count())
        @foreach($comingSoon as $movie)
        <div class="col-md-3 mb-4">
            <div class="card h-100 movie-card position-relative" style="overflow:hidden">
                @if($movie->poster)
                    @if(Str::startsWith($movie->poster, 'http'))
                        <img src="{{ $movie->poster }}" class="card-img-top movie-poster" alt="{{ $movie->title }}" style="width:100%;height:340px;object-fit:cover;">
                    @else
                        <img src="{{ asset('storage/posters/' . $movie->poster) }}" class="card-img-top movie-poster" alt="{{ $movie->title }}" style="width:100%;height:340px;object-fit:cover;">
                    @endif
                @else
                    <img src="https://via.placeholder.com/220x340?text=No+Poster" class="card-img-top movie-poster" alt="No poster" style="width:100%;height:340px;object-fit:cover;">
                @endif
                <div class="movie-overlay d-flex flex-column justify-content-center align-items-center">
                    @if($movie->trailer_url)
                        <button class="btn btn-outline-light btn-trailer mt-2" data-trailer="{{ $movie->trailer_url }}">Xem trailer</button>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $movie->title }}</h5>
                    <p class="card-text">{{ Str::limit($movie->description, 80) }}</p>
                    <span class="badge bg-secondary">{{ $movie->duration }} phút</span>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="col-12 text-center">
            <p>Hiện chưa có phim nào sắp chiếu.</p>
        </div>
    @endif
</div>

<!-- Các modal và script giữ nguyên -->

<!-- Modal yêu cầu đăng nhập -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Yêu cầu đăng nhập</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Bạn cần đăng nhập để đặt vé!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirmLogin">Đăng nhập</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal xem trailer -->
<div class="modal fade" id="trailerModal" tabindex="-1" aria-labelledby="trailerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="trailerModalLabel">Trailer phim</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0" style="height:500px; min-height:400px;">
    <iframe id="trailerFrame" width="100%" height="100%" style="min-height:400px; display:block; background:#000;" frameborder="0" allowfullscreen allow="autoplay"></iframe>
</div>
    </div>
  </div>
</div>

@php $isLoggedIn = auth()->check(); @endphp

@push('styles')
<style>
.movie-poster {
    width: 100%;
    height: 340px;
    object-fit: cover;
    border-radius: 6px 6px 0 0;
}
.movie-card {
    min-height: 500px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: box-shadow 0.3s;
    cursor: pointer;
}
.movie-card:hover {
    box-shadow: 0 0 20px rgba(0,0,0,0.2);
}
.movie-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.6);
    opacity: 0;
    transition: opacity 0.3s;
    z-index: 2;
    display: flex;
}
.movie-card:hover .movie-overlay {
    opacity: 1;
}
.card-body {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    min-height: 120px;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var isLoggedIn = @json($isLoggedIn);

    var trailerFrame = document.getElementById('trailerFrame');
    var trailerModalEl = document.getElementById('trailerModal');
    var loginModalEl = document.getElementById('loginModal');

    if (!trailerFrame || !trailerModalEl || !loginModalEl) {
        console.error('Không tìm thấy các phần tử cần thiết.');
        return;
    }

    var trailerModal = new bootstrap.Modal(trailerModalEl);
    var loginModal = new bootstrap.Modal(loginModalEl);

    document.querySelectorAll('.btn-book').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            if (!isLoggedIn) {
                loginModal.show();
            } else {
                window.location.href = '/bookings/create?movie_id=' + this.dataset.movie;
            }
        });
    });

    document.querySelectorAll('.btn-trailer').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var url = this.dataset.trailer?.trim();
            if (!url) {
                console.error('Không có URL trailer.');
                return;
            }
            // Chuẩn hóa link YouTube về dạng nhúng
            var match = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]{11})/);
            if (match && match[1]) {
                url = `https://www.youtube.com/embed/${match[1]}`;
            }
            // Nếu đã là link embed hoặc link khác thì giữ nguyên
            trailerFrame.src = url;
            trailerFrame.srcdoc = '';
            trailerModal.show();

            trailerFrame.onerror = function() {
                trailerFrame.srcdoc = '<div style="display:flex;align-items:center;justify-content:center;height:100%;color:red;font-size:20px;">Không phát được trailer!</div>';
            };

            trailerModalEl.addEventListener('hidden.bs.modal', function() {
                trailerFrame.src = '';
                trailerFrame.srcdoc = '';
            }, { once: true });
        });
    });
});
</script>
@endpush


@endsection
