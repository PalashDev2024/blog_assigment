@extends('layouts.app')

@section('content')
<h2>Comments on "{{ $post->title }}"</h2>

@foreach($post->comments as $comment)
<div class="border p-2 mb-2">
    <strong>{{ $comment->user->name }}</strong> said:
    <p>{{ $comment->comment }}</p>
    @if(auth()->id() === $comment->user_id || auth()->user()->role === 'admin')
    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-danger">Delete</button>
    </form>
    @endif
</div>
@endforeach

<form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-3">
    @csrf
    <textarea name="comment" class="form-control" rows="3" placeholder="Add your comment..." required></textarea>
    <button class="btn btn-primary mt-2">Post Comment</button>
</form>
@endsection