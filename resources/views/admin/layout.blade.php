<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NPQ Cinema Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Dropdown admin -->
    <div style="position: absolute; top: 16px; right: 32px;">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownAdmin" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::guard('admin')->user()->name ?? 'Admin' }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownAdmin">
                <li><a class="dropdown-item" href="{{ route('admin.password.form') }}">Đổi mật khẩu</a></li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="dropdown-item" type="submit">Đăng xuất</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.movies.index') }}">NPQ Cinema Admin</a>
            <div>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.movies.index') }}">Phim</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.showtimes.index') }}">Suất chiếu</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.bookings.index') }}">Đặt vé</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
