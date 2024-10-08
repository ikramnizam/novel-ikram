@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Novels</h1>
        <a href="{{ route('novels.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Novel
        </a>
    </div>

    <!-- Search Form -->
    <form action="{{ route('novels.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by title or author"
                value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i> Search
            </button>
        </div>
    </form>

    @if ($novels->count())
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>
                        <a href="{{ route('novels.index', ['search' => request('search'), 'sort' => 'title', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
                           class="text-dark text-decoration-none">
                            Title
                            @if (request('sort') === 'title')
                                <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('novels.index', ['search' => request('search'), 'sort' => 'author', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
                           class="text-dark text-decoration-none">
                            Author
                            @if (request('sort') === 'author')
                                <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('novels.index', ['search' => request('search'), 'sort' => 'published_at', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
                           class="text-dark text-decoration-none">
                            Published At
                            @if (request('sort') === 'published_at')
                                <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                            @endif
                        </a>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($novels as $novel)
                    <tr>
                        <td>{{ $novel->title }}</td>
                        <td>{{ $novel->author }}</td>
                        <td>{{ $novel->published_at ? $novel->published_at->format('Y-m-d') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('novels.show', $novel->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Details
                            </a>
                            <a href="{{ route('novels.edit', $novel->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('novels.destroy', $novel->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this novel?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $novels->links('vendor.pagination.bootstrap-4', ['class' => 'pagination-sm']) }}
        </div>
    @else
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i> No novels found. Try adjusting your search.
        </div>
    @endif
</div>
@endsection
