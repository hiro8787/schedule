@extends('layout.default')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/index.css') }}">
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <a href="{{url()->current().'?year='.$previousMonth->format('Y').'&month='.$previousMonth->format('m')}}">前月</a>
    <div class="text-center">
        <strong>{{$thisMonth->format('Y年n月')}}</strong>
    </div>
    <a href="{{url()->current().'?year='.$nextMonth->format('Y').'&month='.$nextMonth->format('m')}}">翌月</a>
</div>
<div class="my-3">
    <div class="calendar-grid">
        @foreach(['(日)', '(月)', '(火)', '(水)', '(木)', '(金)', '(土)'] as $weekName)
        <div class="week-block">
            {{$weekName}}
        </div>
        @endforeach
        @foreach($calendarDays as $calendarDay)
            @if($calendarDay['show'])
            <div class="day-block">
                <form action="./plans/create" method="POST">
                    @csrf
                    <input type="text" name="date" value="{{$calendarDay['date']->format('Y-m-d')}}" hidden>
                    @switch($calendarDay['date']->dayOfWeek)
                        @case(6)
                            <button class="bg-saturday" type="submit" id="js-button">
                                <div class="date-number">{{$calendarDay['date']->format('j')}}
                                    @foreach($holidaysList as $holiday)
                                        @if($calendarDay['date']->format('Y-m-d') === $holiday['date'])
                                            <div class="holiday-name">{{$holiday['name']}}</div>
                                        @endif
                                    @endforeach
                                    @foreach($schedules as $schedule)
                                        @if($schedule['date'] === $calendarDay['date']->format('Y-m-d'))
                                            <div class="schedule-title">{{ $schedule['title'] }}</div>
                                        @endif
                                    @endforeach
                                </div>
                            </button>
                            @break
                            @case(0)
                            <button class="bg-sunday" type="submit" id="js-button">
                                <div class="date-number">{{$calendarDay['date']->format('j')}}
                                    @foreach($holidaysList as $holiday)
                                        @if($calendarDay['date']->format('Y-m-d') === $holiday['date'])
                                            <div class="holiday-name">{{$holiday['name']}}</div>
                                        @endif
                                    @endforeach
                                    @foreach($schedules as $schedule)
                                        @if($schedule['date'] === $calendarDay['date']->format('Y-m-d'))
                                            <div class="schedule-title">{{ $schedule['title'] }}</div>
                                        @endif
                                    @endforeach
                                </div>
                            </button>
                            @break
                            @default
                            <button class="button-day" type="submit" id="js-button">
                                <div class="date-number">{{$calendarDay['date']->format('j')}}
                                    @foreach($holidaysList as $holiday)
                                        @if($calendarDay['date']->format('Y-m-d') === $holiday['date'])
                                            <div class="holiday-name">{{$holiday['name']}}</div>
                                        @endif
                                    @endforeach
                                    @foreach($schedules as $schedule)
                                        @if($schedule['date'] === $calendarDay['date']->format('Y-m-d'))
                                            <div class="schedule-title">{{ $schedule['title'] }}</div>
                                        @endif
                                    @endforeach
                                </div>
                            </button>
                        @endswitch
                    </form>
                </div>
            @else
                <div class="day-block"></div>
            @endif
        @endforeach
    </div>
    <div class="plan-list">
        <a href="./plans/list">予定一覧</a>
    </div>
</div>
<script src="{{ asset('/js/calendar.js') }}"></script>
@endsection
