<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/default.css') }}" />
    @yield('css')
    <title>Schedule</title>
</head>
<body>
    <div class="title">
        <h1 class="title-header">スケジュール管理アプリ</h1>
    </div>
    @if (Auth::check())
        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">ログアウト</button>
            </form>
        </div>
    @endif
    @yield('content')
</body>
</html>