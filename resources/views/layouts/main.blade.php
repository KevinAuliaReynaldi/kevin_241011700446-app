<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Saya')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>Laravel App</h1>
        <nav>
            <a href="/">Home</a>
            <a href="/produk">Produk</a>
        </nav>
    </header>
</body>
</html>