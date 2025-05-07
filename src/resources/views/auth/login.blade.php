@extends('layout.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert">
            {{ session('message') }}
        </div>
    @endif
    <h2>ログイン</h2>
    <form action="/" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" placeholder="例：sample@example.com" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password" placeholder="例：abcd1234">
        </div>
        <button type="submit">ログイン</button>
    </form>
    <div class="register-link">
        <a href="{{ route('register') }}">新規登録はこちら</a>
    </div>
</div>
@endsection