<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::all();
        return view('attendances.index', ['attendances' => $attendances]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->status == 'clock in') {
            $num=Employee::findOrFail($request->employee_id)->attendances()
                                                ->where('clocked_in_at', '>=', now()->subHours(24))
                                                ->where('clocked_out_at', null)->count();
            if ($num > 0) {
                return back()->with("error","Employee already clocked in!");
            }
           
            
        
            $attendance = Attendance::create([

                'employee_id' => $request->employee_id,
                'status' => $request->status
            ]);
        } else if ($request->status == 'clock out'){
            // fetch emp attendances within 24hrs
            // fetch the ones that have not been clocked out
            // fetch the most rescent

         
            $attendance=Employee::findOrFail($request->employee_id)->attendances()
                                                ->where('clocked_in_at', '>=', now()->subHours(24))
                                                ->where('clocked_out_at', null)
                                                ->orderBy('clocked_in_at','desc')
                                                ->first();
           
            $attendance->clocked_out_at=now();
            
            //dd($attendance);
            $attendance->save();
        }
        // dd($employee);

        return back()->with("success","Employee attendance successfully updated!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    Public function update(Request $request, Attendance $attendance)
    {
        $attendance->update(request()->validate([
            'clocked_in_at' => 'required',
            'clocked_out_at' => 'required'
        ]));
    //     $attendance->$request->validate([
    //         'clocked_in_at',
    //         'clocked_out_at'
    //     ]);
    //    $attendance = Attendance::update($request->all);
    //    // $attendance->update($request->all());
        return redirect()->route('attendances.index')

            ->with('success', 'Attendance record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('error', 'Attendance record deleted successfully');
    }
}
