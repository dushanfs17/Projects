<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\Category;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks with filters.
     */
    public function index(Request $request)
    {
        // Load all categories and projects
        $categories = Category::all();
        $projects = Project::all();

        // Load all fields for project and category
        $query = Task::with(['project', 'category']);

        // Apply filters
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tasks = $query->get();

        if ($request->expectsJson()) {
            return TaskResource::collection($tasks);
        }

        return view('tasks.index', compact('tasks', 'categories', 'projects'));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());

        if ($request->expectsJson()) {
            return new TaskResource($task);
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function update(Request $request, Task $task)
    {
        return $this->updateTaskStatus($request, $task, $request->input('status', 'pending'));
    }

    /**
     * Mark a task as completed (API-specific).
     */
    public function complete(Task $task)
    {
        return $this->updateTaskStatus(request(), $task, 'completed');
    }

    /**
     * Mark a task as in progress (API-specific).
     */
    public function progress(Task $task)
    {
        return $this->updateTaskStatus(request(), $task, 'in_progress');
    }

    /**
     * Helper method to update task status and handle web/API responses.
     */
    protected function updateTaskStatus(Request $request, Task $task, string $newStatus)
    {
        // Validate status (only needed if provided by request)
        if ($request->has('status')) {
            $validatedData = $request->validate([
                'status' => 'required|in:pending,in_progress,completed',
            ]);
            $newStatus = $validatedData['status'];
        }

        // Prevent changing status if already completed
        if ($task->status === 'completed' && $newStatus !== 'completed') {
            return $this->respondWithError($request, 'Cannot change status of a completed task.');
        }

        // Update the task status
        $task->update(['status' => $newStatus]);

        // Return appropriate response based on request type
        return $this->respondWithSuccess($request, $task, "Task status updated to '$newStatus' successfully.");
    }

    /**
     * Handle error response for web or API.
     */
    protected function respondWithError(Request $request, string $message)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => $message], 400);
        }
        return redirect()->route('tasks.index')->with('error', $message);
    }

    /**
     * Handle success response for web or API.
     */
    protected function respondWithSuccess(Request $request, Task $task, string $message)
    {
        if ($request->expectsJson()) {
            return new TaskResource($task);
        }
        return redirect()->route('tasks.index')->with('success', $message);
    }
}
