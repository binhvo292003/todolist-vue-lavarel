<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return Todo::all();
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'completed' => 'required|boolean',
        ]);

        $todo = Todo::create($request->all());

        return response()->json([
            'message' => 'Post created successfully.',
            'todo' => $todo
        ], 201);
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'completed' => 'required|boolean',
        ]);

        $todo->update($request->all());

        return response()->json([
            'message' => 'Update todo successfully.'
        ], 200);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json([
            'message' => 'Delete todo successfully.'
        ], 200);
    }

    public function destroyAll()
    {
        Todo::truncate();

        return response()->json([
            'message' => 'Delete all todo successfully.'
        ], 200);
    }
}
