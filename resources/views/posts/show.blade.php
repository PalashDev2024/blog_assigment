@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $post->title }}</h2>
    <p class="text-muted">
        By <strong>{{ $post->user->name }}</strong> • {{ $post->created_at->diffForHumans() }}
    </p>
    <div class="mt-3 mb-4">
        {!! nl2br(e($post->content)) !!}
    </div>

    <hr>

    <h4>Comments</h4>

    @if($post->comments->count())
    @foreach($post->comments as $comment)
    <div class="border rounded p-2 mb-2">
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->comment }}</p>
        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>

        @if(auth()->id() === $comment->user_id || auth()->user()->role === 'admin')
        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-2">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">Delete</button>
        </form>
        @endif
    </div>
    @endforeach
    @else
    <p>No comments yet.</p>
    @endif

    <hr>

    <h5>Add a Comment</h5>
    <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment..."
                required></textarea>
        </div>
        <button class="btn btn-primary">Post Comment</button>
    </form>

    <div class="mt-4">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">← Back to Posts</a>
    </div>
</div>
@endsection