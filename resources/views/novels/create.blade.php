@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Novel</h1>
        <form action="{{ route('novels.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required> 
            </div>

            <div class="form-group mt-3">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="synopsis">Synopsis</label>
                <textarea name="synopsis" class="form-control" required>{{ old('synopsis') }}</textarea>
            </div>

            <div class="form-group mt-3">
                <label for="published_at">Published At</label>
                <input type="date" name="published_at" class="form-control" value="{{ old('published_at') }}" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">Create</button>
        </form>
    </div>
@endsection

{{-- If the user submitted a form and validation failed, the old('title') will return the value that the user previously entered in the "title" field. --}}
