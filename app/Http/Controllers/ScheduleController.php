<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('todo.index', [
            'all_task' => Schedule::all()->where('user_id', auth()->id()),
            'total_task' => Schedule::count(),
            'finished_item' => Schedule::where('status', 1)->count(),
            'pending_item' => Schedule::where('status', 0)->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required',
            'task_time' => "required",
        ]);
        Schedule::insert([
            'user_id' =>  auth()->id(),
            'task_name' => $request->task_name,
            'task_time' => $request->task_time,
            'created_at' => Carbon::now()
        ]);
        return redirect('todo')->with('success', "Task added successfully");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule, $id)
    {
        return view('todo.edit', [
            'task' => Schedule::find(Crypt::decrypt($id))
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule, $id)
    {
        $request->validate([
            'task_name' => 'required',
            'task_time' => "required",
        ]);
        Schedule::find(Crypt::decrypt($id))->update([
            'task_name' => $request->task_name,
            'task_time' => $request->task_time,
            'updated_at' => Carbon::now()
        ]);
        return redirect('todo')->with('success', 'task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule, $id)
    {
        // return $id;
        Schedule::find($id)->delete();
        // return $schedule;
        // $schedule->delete();
        return back()->with('success', "Task deleted successfully");
    }
    // change Status
    public function status($id)
    {

        $schedule = Schedule::find(Crypt::decrypt($id));
        if ($schedule->status == 0) {
            $updated_status = 1;
        } else {
            $updated_status = 0;
        }
        $schedule->update([
            'status' => $updated_status,
            'updated_at' => Carbon::now()
        ]);
        return back()->with('success', "Task updated successfully");
    }
    // done all
    public function markAllDone(Request $request)
    {
        DB::table('schedules')->update(['status' => 1]);
        return back()->with('success', "All task completed");
    }
    // undone all
    public function markAllUndone(Request $request)
    {
        DB::table('schedules')->update(['status' => 0]);
        return back()->with('success', "All task pending");
    }
    // undone all
    public function clear(Request $request)
    {
        DB::table('schedules')->delete();
        return back()->with('success', "All task cleared");
    }
    // undone all
    public function deleteSelected(Request $request)
    {
        return "hello";
        // DB::table('schedules')->delete();
        // return back()->with('success', "All task cleared");
    }
}
