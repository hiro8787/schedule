<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();
        if(!$user){
            return redirect('login');
        }
        $schedule = Schedule::select('date')->get();
        $date = $request->input('date');
        return view('plans.create',[
            'date' => $date,
            'schedule' => $schedule,
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        if(!$request->input('id')){
            $schedule = Schedule::create([
                'user_id' => $request->input('user_id'),
                'title' => $request->input('title'),
                'date' => $request->input('date'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time'),
            ]);
        } else {
            $schedule = Schedule::find($request->input('id'));
            $scheduleId = $schedule->id;
            $title = $schedule->title;
        }
        return view('plans.store',compact('schedule'));
    }

    public function edit(Request $request)
    {
        $schedule = Schedule::find($request->id);
        $schedule->update([
            'title' => $request->input('title'),
            'date' => $request->input('date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);
        return view('plans.edit',compact('schedule'));
    }

    public function list()
    {
        $userId = Auth::user()->id;
        $schedules = Schedule::where('user_id', $userId)->orderBy('date')
            ->orderBy('start_time')
            ->get();
        return view('plans.list', compact('schedules'));
    }

    public function delete(Request $request)
    {
        $schedule = Schedule::find($request->id);
        $schedule->delete();
        $scheduleTitle = $schedule->title;
        return redirect()->route('plans.list')->with('message', $scheduleTitle.'を削除しました。');
    }
}
