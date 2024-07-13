<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::where('user_id', auth()->id())->get();
    }

    public function store(Request $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return response()->json($task, 201);
    }

    public function show($id)
    {
        return Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    }

    public function update(Request $request, $id)
    {
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $task->update($request->only('title', 'description', 'is_completed'));

        return response()->json($task, 200);
    }

    public function destroy($id)
    {
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $task->delete();

        return response()->json(null, 204);
    }
}
