@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users List</h1>
    <ul>
        @foreach($users as $user)
            <li><a href="{{ route('admin.show', $user->id) }}">{{ $user->name }}</a></li>
        @endforeach
    </ul>
</div>
@endsection