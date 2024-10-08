@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">{{ $novel->title }}</h1>
            </div>
            <div class="card-body">
                <p><strong>Author:</strong> <span class="">{{ $novel->author }}</span></p>
                <p><strong>Published At:</strong> <span class="">{{ $novel->published_at->format('Y-m-d') }}</span></p>
                <p><strong>Synopsis:</strong></p>
                <p class="text-justify">{{ $novel->synopsis }}</p>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('novels.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <div>
                        <a href="{{ route('novels.edit', $novel->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('novels.destroy', $novel->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this novel?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

