<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // Apply filtering if the 'due_date' query parameter is present
        $projects = Project::when($request->due_date, function ($query) use ($request) {
            return $query->whereDate('due_date', $request->due_date);
        })
            ->get();

        return view('projects.index', compact('projects'));
    }

    public function store(StoreProjectRequest $request)
    {
        // Store the new project in the database
        Project::create($request->validated());

        // Redirect back to the projects index page after project creation
        return redirect()->route('projects.index')->with('success', 'Project created successfully!');
    }
}
