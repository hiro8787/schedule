@extends('layout.default')

@section('content')
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif
    <h1>予定一覧画面</h1>
    @foreach ($schedules as $schedule)
    <ul>
        <li>予定タイトル：{{ $schedule->title }}</li>
        <li>予定日：{{ $schedule->date }}</li>
        <li>予定開始時間：{{ $schedule->start_time }}</li>
        <li>予定終了時間：{{ $schedule->end_time }}</li>
    </ul>
    <form action="{{ route('plans.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $schedule->id }}">
        <input type="hidden" name="title" value="{{ $schedule->title }}">
        <input type="hidden" name="date" value="{{ $schedule->date }}">
        <input type="hidden" name="start_time" value="{{ $schedule->start_time }}">
        <input type="hidden" name="end_time" value="{{ $schedule->end_time }}">
        <button type="submit">予定修正</button>
    </form>
    <form action="{{ route('plans.delete') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $schedule->id }}">
        <button type="submit">予定削除</button>
    </form>
    @endforeach
    <div>
        <a href="/">TOPへ戻る</a>
    </div>
@endsection