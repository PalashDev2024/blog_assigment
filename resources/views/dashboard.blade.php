@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1>Welcome, {{ auth()->user()->name }}!</h1>
    <p>Your role: <strong>{{ auth()->user()->role }}</strong></p>

    <div class="mt-4">
        <a href="{{ route('posts.index') }}" class="btn btn-primary me-2">Go to Posts</a>

        @if(auth()->user()->role === 'admin')
        <a href="{{ route('users.create') }}" class="btn btn-success me-2">
            ➕ Create User
        </a>
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
            👥 Manage Users
        </a>
        @endif
    </div>
</div>
@endsection