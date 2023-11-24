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
        return view('task.index')->with('tasks', Task::open()->paginate(5));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $targetModel = match ($request->target_model) {
            'business' => Business::find($request->taskable_id),
            'person' => Person::find($request->taskable_id),
        };

        $targetModel->tasks()->create([
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
