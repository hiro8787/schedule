@extends('layout.default')

@section('content')
<div class="container">
    <h2>新規登録</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        @if (count($errors) > 0)
            <p class="error-message">入力に問題があります。</P>
        @endif
        <div class="form-group">
            <label for="text">名前</label>
            <input type="text" name="name" placeholder="例：鈴木太郎" value="{{ old('name') }}">
        </div>
        @if ($errors->has('name'))
            <p class="error-massage">{{ $errors->first('name')}}</p>
        @endif
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" placeholder="例：sample@example.com" value="{{ old('email') }}">
        </div>
        @if ($errors->has('email'))
            <p class="error-massage">{{ $errors->first('email')}}</p>
        @endif
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password" placeholder="例：abcd1234">
        </div>
        @if ($errors->has('password'))
            <p class="error-massage">{{ $errors->first('password')}}</p>
        @endif
        <div class="form-group">
            <label for="password">確認用パスワード</label>
            <input type="password" name="password_confirmation" placeholder="もう一度入力してください">
        </div>
        <button type="submit">登録</button>
    </form>
</div>
@endsection