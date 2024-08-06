<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Timesheet;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('timesheets')->where('role', 'employee')->get();
        return view('admin.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('timesheets')->find($id);
        if (!$user || $user->role !== 'employee') {
            return redirect()->back()->withErrors('Invalid user.');
        }

        return view('admin.show', compact('user'));
    }
}
