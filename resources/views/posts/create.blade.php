@extends('layouts.app')

@section('content')
<h2>Create Post</h2>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Content</label>
        <textarea name="content" class="form-control" rows="5" required></textarea>
    </div>
    <button class="btn btn-primary">Submit</button>
</form>
@endsection