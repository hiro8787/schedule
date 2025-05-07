<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Calendar\CalendarView;
use Illuminate\Http\Request;
use Carbon\Carbon;
use \Yasumi\Yasumi;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index(Request $request){
        // 表示したい年を取得。デフォルト値には本日の年を指定。
        $year = $request->query('year')??Carbon::today()->format('Y');
        // 表示したい月を取得。デフォルト値には本日の月を指定。
        $month = $request->query('month')??Carbon::today()->format('m');
        // 表示する年月の初日・日時を作る。01は日付 00,00,00は00時00分00秒を指定
        $calendarYm = Carbon::create($year, $month, 01, 00, 00, 00);
        // カレンダーの日付を格納する配列を作成
        $calendarDays = [];
        /*
        dayOfWeekは0から6までの数字で、0が日曜日、1が月曜日、2が火曜日、3が水曜日、4が木曜日、5が金曜日、6が土曜日を表す
        そのため、月の初日が日曜日でない場合は、前の月の日付を追加しカレンダーの最初の日曜日から表示することができる
        */
        // 月の初日が日曜日でない場合の条件分岐とループ処理
        if($calendarYm->dayOfWeek != 0){
            // subDaysメソッドで$calendarYmの曜日番号分だけ日付を引き算して、前の月の日付を取得
            $calendarStartDay = $calendarYm->copy()->subDays($calendarYm->dayOfWeek);
            // ループ処理で前の月の日付を追加
            // 0から$calendarYm->dayOfWeekまでの数字をループ処理
            // $calendarYm->dayOfWeekは0から6までの数字なので、$iは0から$calendarYm->dayOfWeek-1までの数字をループ処理
            for($i = 0; $i < $calendarYm->dayOfWeek; $i++){
                // $calendarStartDay->copy()->addDays($i)で$calendarStartDayの日付を$iの数字分加算し、前の月の日付をdateに格納し、$calendarDaysに追加
                $calendarDays[] = ['date' => $calendarStartDay->copy()->addDays($i), 'show' => false, 'status'=>false];
            }
            //dd($calendarDays);
        }
        // dayInMonthメソッドで$calendarYmの月の日数を取得して、ループ処理で当月の日付を追加
        for($i = 0; $i < $calendarYm->daysInMonth; $i++){
            if($calendarYm->copy()->addDays($i)>=Carbon::now()){
                $show = true;
                $status = true;
            } else {
                $show = true;
                $status = false;
            }
            $calendarDays[] = ['date' => $calendarYm->copy()->addDays($i), 'show' => $show, 'status'=>$status];
        }

        if($calendarYm->copy()->endOfMonth()->dayOfWeek != 6) {
            for($i = $calendarYm->copy()->endOfMonth()->dayOfWeek+1; $i < 7; $i++) {
                $calendarDays[] = ['date' => $calendarYm->copy()->endOfMonth()->addDays($i), 'show' => false, 'status'=>false];
            }
        }
        // 祝日の取得
        $year = Carbon::now()->year;
        $holidays = Yasumi::create('Japan', $year, 'ja_JP');
        $holidaysList = [];

        foreach($holidays as $holiday) {
            $holidaysList[] = [
                'name' => $holiday->getName(),
                'date' => $holiday->format('Y-m-d')
            ];
        }

        $id = Auth::id();
        $schedules = Schedule::select('date', 'title')->where('user_id', $id)->get();

        return view('/index', [
            'calendarDays' => $calendarDays,//集めた日付
            'previousMonth' => $calendarYm->copy()->subMonth(),//前月
            'nextMonth' => $calendarYm->copy()->addMonth(),//翌月
            'thisMonth' => $calendarYm,//当月
            'schedules' => $schedules,//スケジュール
            'holidaysList' => $holidaysList,//祝日
        ]);
    }
}
