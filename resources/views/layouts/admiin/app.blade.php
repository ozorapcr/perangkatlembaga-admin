<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; }
        .sidebar {
            width: 240px; background: #1a1a1a; color: white; padding: 1rem;
        }
        .sidebar a { color: #bbb; text-decoration: none; display: block; margin: 10px 0; }
        .sidebar a:hover { color: #fff; }
        .content { flex: 1; padding: 2rem; background: #f8f9fa; }
        .header { background: #fff; padding: 1rem; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>
    @include('layouts.admin.sidebar')

    <div class="flex-grow-1">
        @include('layouts.admin.header')

        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>
