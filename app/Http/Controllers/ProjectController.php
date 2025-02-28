<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index(Request $request)
    {
        $projects = Project::all();

        // Check if the request expects JSON response
        if ($request->expectsJson()) {
            return ProjectResource::collection($projects);
        }

        return view('projects.index', compact('projects'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());

        // Check if the request expects JSON response
        if ($request->expectsJson()) {
            return new ProjectResource($project);
        }

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }
}
