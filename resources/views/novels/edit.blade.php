@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1>Edit Novel</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('novels.update', $novel->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to update this novel?');">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title', $novel->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" 
                               value="{{ old('author', $novel->author) }}" required>
                        @error('author')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="synopsis" class="form-label">Synopsis</label>
                        <textarea name="synopsis" class="form-control @error('synopsis') is-invalid @enderror" rows="4" required>{{ old('synopsis', $novel->synopsis) }}</textarea>
                        @error('synopsis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="published_at" class="form-label">Published At</label>
                        <input type="date" name="published_at" class="form-control @error('published_at') is-invalid @enderror" 
                               value="{{ old('published_at', $novel->published_at->format('Y-m-d')) }}" required>
                        @error('published_at')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success mt-3" onsubmit="return confirm('Are you sure you want to delete this novel?');"    >
                        <i class="fas fa-save"></i> Update
                    </button>
                    
                    <a href="{{ route('novels.index') }}" class="btn btn-secondary mt-3">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
