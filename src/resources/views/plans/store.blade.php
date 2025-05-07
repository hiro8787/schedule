@extends('layout.default')

@section('content')
    <h2>予定登録完了画面</h2>
    <form action="{{ route('plans.edit') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $schedule->id }}">
        <input type="date" name="date" value="{{ $schedule->date }}">
        <div>
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" value="{{ $schedule->title }}" required>
        </div>
        <div>
            <label for="start_time">開始時間</label>
            <input type="time" name="start_time" id="start_time" value="{{ $schedule->start_time }}" required>
        </div>
        <div>
            <label for="end_time">終了時間</label>
            <input type="time" name="end_time" id="end_time" value="{{ $schedule->end_time }}" required>
        </div>
        <button type="submit">予定修正</button>
    </form>
    <div>
        <a href="/">TOPへ戻る</a>
    </div>
@endsection