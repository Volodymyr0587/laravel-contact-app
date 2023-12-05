<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Person;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $tasks = Task::where('user_id', $userId);
        return view('task.index')->with('tasks', $tasks->open()->paginate(10));
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $targetModel = match ($request->target_model) {
            'business' => Business::find($request->taskable_id),
            'person' => Person::find($request->taskable_id),
        };

        $targetModel->tasks()->create([
            'user_id' => $userId,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back();
    }

    public function complete(Request $request, Task $task)
    {
        $task->markAsCompleted();
        return redirect()->back();
    }
}
