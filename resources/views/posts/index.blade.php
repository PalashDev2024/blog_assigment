@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>All Posts</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
</div>

@foreach($posts as $post)
<div class="card mb-3">
    <div class="card-body">
        <h4>{{ $post->title }}</h4>
        <p>{{ Str::limit($post->content, 150) }}</p>
        <small>By {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</small>
        <div class="mt-2">
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-primary">View</a>
            @can('update', $post)
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
            @endcan
            @can('delete', $post)
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
            </form>
            @endcan
        </div>
    </div>
</div>
@endforeach
@endsection