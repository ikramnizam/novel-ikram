<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Novel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NovelController extends Controller
{
    // GET /api/novels: List all novels
    public function index()
    {
        $novels = Novel::all();
        return response()->json($novels, 200);
    }

    // GET /api/novels/{id}: Get details of a specific novel
    public function show($id)
    {
        $novel = Novel::find($id);
        if (!$novel) {
            return response()->json(['error' => 'Novel not found'], 404);
        }
        return response()->json($novel, 200);
    }

    // POST /api/novels: Create a new novel
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $novel = Novel::create($request->all());

        return response()->json($novel, 201);
    }

    // PUT /api/novels/{id}: Update an existing novel
    public function update(Request $request, $id)
    {
        $novel = Novel::find($id);
        if (!$novel) {
            return response()->json(['error' => 'Novel not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $novel->update($request->all());

        return response()->json($novel, 200);
    }

    // DELETE /api/novels/{id}: Delete a novel
    public function destroy($id)
    {
        $novel = Novel::find($id);
        if (!$novel) {
            return response()->json(['error' => 'Novel not found'], 404);
        }

        $novel->delete();

        return response()->json(['message' => 'Novel deleted successfully'], 200);
    }
}
