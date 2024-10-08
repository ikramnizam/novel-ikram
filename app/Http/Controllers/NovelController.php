<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NovelController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Display a list of novels belonging to the authenticated user
    public function index(Request $request)
    {
        // Start the query for the novels associated with the authenticated user
        $query = Novel::where('user_id', Auth::id());
    
        // Implement search functionality
        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('author', 'like', "%{$searchTerm}%");
        }
    
        // Check if there's a sort query
        if ($request->has('sort')) {
            $sortBy = $request->input('sort');
            $direction = $request->input('direction', 'asc'); // Default to ascending
            $query->orderBy($sortBy, $direction);
        } else {
            // Default sorting
            $query->orderBy('published_at', 'desc'); // Default sort by latest published
        }
        // dd($query);
    
        // Pagination: 3 novels per page
        $novels = $query->paginate(3);
        return view('novels.index', compact('novels'));
    }
    

    // Show the form for creating a new novel
    public function create()
    {
        return view('novels.create');
    }

    // Store a new novel in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        $novel = new Novel($validated);
        $novel->user_id = Auth::id(); // Associate the novel with the authenticated user
        $novel->save();

        return redirect()->route('novels.index');
    }

    // Display a specific novel
    public function show(Novel $novel)
    {
        // Ensure the novel belongs to the authenticated user
        if ($novel->user_id != Auth::id()) {
            abort(403);
        }

        // dd($novel);

        return view('novels.show', compact('novel'));
    }

    // Show the form for editing a novel
    public function edit(Novel $novel)
    {
        // Ensure the novel belongs to the authenticated user
        if ($novel->user_id != Auth::id()) {
            abort(403);
        }

        return view('novels.edit', compact('novel'));
    }

    // Update the specified novel in the database
    public function update(Request $request, Novel $novel)
    {
        // Ensure the novel belongs to the authenticated user
        if ($novel->user_id != Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        $novel->update($validated);

        return redirect()->route('novels.index');
    }

    // Delete a novel from the database
    public function destroy(Novel $novel)
    {
        // Ensure the novel belongs to the authenticated user
        if ($novel->user_id != Auth::id()) {
            abort(403);
        }

        $novel->delete();

        return redirect()->route('novels.index');
    }
}
