<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenant Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-md-2 bg-light pt-4">
            <h5>{{ Auth::guard('tenant')->user()->name }}</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tenant.dashboard') }}">Home</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('tenant.logout') }}">
                        @csrf
                        <button class="btn btn-link nav-link">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        {{-- Content --}}
        <div class="col-md-10 pt-4">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>