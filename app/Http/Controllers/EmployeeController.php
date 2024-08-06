<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timesheet;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $timesheets = Auth::user()->timesheets;
        return view('employee.index', compact('timesheets'));
    }

    public function clockIn()
    {
        $timesheet = Timesheet::where('user_id', Auth::id())
                              ->whereNull('end_time')
                              ->first();

        if ($timesheet) {
            return redirect()->back()->withErrors('You already have an active timesheet.');
        }

        $timesheet = new Timesheet();
        $timesheet->user_id = Auth::id();
        $timesheet->start_time = now();
        $timesheet->save();

        return redirect()->back()->with('success', 'Clocked in successfully.');
    }

    public function breakStart($id)
    {
        $timesheet = Timesheet::find($id);

        if (!$timesheet || $timesheet->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('Invalid timesheet.');
        }

        if ($timesheet->break_start_time) {
            return redirect()->back()->withErrors('You are already on break.');
        }

        $timesheet->break_start_time = now();
        $timesheet->save();

        return redirect()->back()->with('success', 'Break started successfully.');
    }

    public function breakEnd($id)
    {
        $timesheet = Timesheet::find($id);

        if (!$timesheet || $timesheet->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('Invalid timesheet.');
        }

        if (!$timesheet->break_start_time || $timesheet->break_end_time) {
            return redirect()->back()->withErrors('You are not on break.');
        }

        $timesheet->break_end_time = now();
        $timesheet->save();

        return redirect()->back()->with('success', 'Break ended successfully.');
    }

    public function clockOut($id)
    {
        $timesheet = Timesheet::find($id);

        if (!$timesheet || $timesheet->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('Invalid timesheet.');
        }

        if ($timesheet->end_time) {
            return redirect()->back()->withErrors('You have already clocked out.');
        }

        $timesheet->end_time = now();
        $timesheet->save();

        return redirect()->back()->with('success', 'Clocked out successfully.');
    }
}
