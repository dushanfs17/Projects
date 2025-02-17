<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // Query for tasks with filters
        $tasks = Task::when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->with(['project:id,name', 'category:id,name'])
            ->get();

        // Return the tasks with the custom resource
        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());
        return new TaskResource($task);
    }

    public function complete(Task $task)
    {
        // Check if the task is not in "in_progress" status
        if ($task->status !== 'in_progress') {
            return response()->json(['error' => 'Only tasks in progress can be marked as completed.'], 400);
        }

        // Update the task status to "completed"
        $task->update(['status' => 'completed']);

        // Return the updated task as a resource
        return new TaskResource($task);
    }
}
