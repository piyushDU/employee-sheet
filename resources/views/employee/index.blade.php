@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Your Timesheet</h1>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold mb-3">Timesheet Entries</h2>
        @if($timesheets->isEmpty())
            <p class="text-gray-500">No timesheet entries found.</p>
        @else
            <ul class="space-y-4">
                @foreach($timesheets as $timesheet)
                    <li class="border border-gray-200 rounded-lg p-4">
                        <div class="mb-2">
                            <strong class="text-gray-700">Start:</strong> 
                            {{ $timesheet->start_time }}
                        </div>
                        <div class="mb-2">
                            <strong class="text-gray-700">Break Start:</strong> 
                            {{ $timesheet->break_start_time }}
                        </div>
                        <div class="mb-2">
                            <strong class="text-gray-700">Break End:</strong> 
                            {{ $timesheet->break_end_time }}
                        </div>
                        <div class="mb-2">
                            <strong class="text-gray-700">End:</strong> 
                            {{ $timesheet->end_time }}
                        </div>
                        <div>
                            <strong class="text-gray-700">Total:</strong> 
                            {{ $timesheet->start_time->diffInMinutes($timesheet->end_time) }} minutes
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <form action="{{ route('employee.clockIn') }}" method="POST">
        @csrf
        <button type="submit">Clock In</button>
    </form>
    
</div>
@endsection
