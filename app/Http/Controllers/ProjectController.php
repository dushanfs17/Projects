<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::when($request->due_date, fn($q) => $q->whereDate('due_date', $request->due_date))
            ->get();

        return view('projects.index', compact('projects'));
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());
        return new ProjectResource($project);
    }
}
