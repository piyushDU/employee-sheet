@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $user->name }}'s Timesheet</h1>
    <ul>
        @foreach($user->timesheets as $timesheet)
            <li>
                Start: {{ $timesheet->start_time }} <br>
                Break Start: {{ $timesheet->break_start_time }} <br>
                Break End: {{ $timesheet->break_end_time }} <br>
                End: {{ $timesheet->end_time }} <br>
                Total: {{ $timesheet->start_time->diffInMinutes($timesheet->end_time) }} minutes
            </li>
        @endforeach
    </ul>
</div>
@endsection