@extends('layout.default')

@section('content')
    @if ($schedule === $date)
        <p>既に予定が入っている</p>
    @endif
    <h2>予定登録</h2>
    <form action="{{ route('plans.store') }}" method="POST">
        @csrf
        <h2>{{ $date }}</h2>
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="date" name="date" value="{{ $date }}" hidden>
        <div>
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="start_time">開始時間</label>
            <input type="time" name="start_time" id="start_time" required>
        </div>
        <div>
            <label for="end_time">終了時間</label>
            <input type="time" name="end_time" id="end_time" required>
        </div>
        <button type="submit">登録</button>
    </form>
    <div>
        <a href="{{ url()->previous() }}">戻る</a>
    </div>
@endsection
