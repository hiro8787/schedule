@extends('layout.default')

@section('content')
    <h2>予定変更完了画面</h2>
        <p>予定タイトル：{{ $schedule->title }}</p>
        <p>予定日：{{ $schedule->date }}</p>
        <p>予定開始時間：{{ $schedule->start_time }}</p>
        <p>予定終了時間：{{ $schedule->end_time }}</p>
    <div>
        <a href="/">TOPへ戻る</a>
    </div>
@endsection