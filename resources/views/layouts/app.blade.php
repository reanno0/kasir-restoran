<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Kasir Restoran')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f5f7; }
        nav { background: #1f3a5f; color: #fff; padding: 12px 24px; display: flex; justify-content: space-between; align-items: center; }
        nav button { background: #c0392b; color: #fff; border: 0; padding: 8px 14px; border-radius: 4px; cursor: pointer; }
        .container { max-width: 900px; margin: 24px auto; padding: 0 16px; }
        .card { background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
        input { width: 100%; padding: 10px; margin: 6px 0 14px; box-sizing: border-box; }
        .btn { background: #1f3a5f; color: #fff; border: 0; padding: 10px 16px; border-radius: 4px; cursor: pointer; }
        .error { color: #c0392b; margin-bottom: 10px; }
    </style>
</head>
<body>
    @auth
    <nav>
        <span>Kasir Restoran | {{ auth()->user()->namauser }} ({{ auth()->user()->role }})</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>
    @endauth

    <div class="container">
        @yield('content')
    </div>
</body>
</html>