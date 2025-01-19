<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Log;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('status', false)->paginate(5);
        $completedTasks = Task::where('status', true)->paginate(5);
        return view('tasks.index', compact('tasks', 'completedTasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::create($validated);
        Log::create(['task_id' => $task->id, 'action' => 'added']);

        return redirect()->back()->with('success', 'Task added successfully.');
    }

    public function updateStatus(Task $task)
    {
        $task->status = !$task->status;
        $task->save();

        $action = $task->status ? 'moved to done' : 'moved to not done';
        Log::create(['task_id' => $task->id, 'action' => $action]);

        return redirect()->back()->with('success', 'Task status updated.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task->update($validated);
        Log::create(['task_id' => $task->id, 'action' => 'edited']);

        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        Log::create(['task_id' => $task->id, 'action' => 'deleted']);
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted.');
    }

    public function logs()
    {
        $logs = Log::with('task')->paginate(10);
        return view('tasks.logs', compact('logs'));
    }
}

