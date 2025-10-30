@extends('layouts.app')

@section('content')
<h2>Admin Dashboard</h2>
<div class="row text-center">
    <div class="col-md-4">
        <div class="card p-3">
            <h4>Users</h4>
            <p>{{ $users }}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h4>Posts</h4>
            <p>{{ $posts }}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h4>Comments</h4>
            <p>{{ $comments }}</p>
        </div>
    </div>
</div>
@endsection