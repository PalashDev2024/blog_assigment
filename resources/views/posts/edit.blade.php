@extends('layouts.app')

@section('content')
<h2>Edit Post</h2>

<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
    </div>
    <div class="mb-3">
        <label>Content</label>
        <textarea name="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
    </div>
    <button class="btn btn-success">Update</button>
</form>
@endsection