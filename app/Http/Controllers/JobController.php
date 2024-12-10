<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('dashboard.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('dashboard.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time',
            'work_mode' => 'required|in:hybrid,on-site',
            'location' => 'required|string|max:255',

        ]);

        Job::create($validated);
        return redirect()->route('jobs.index')->with('success', 'Job created successfully!');
    }

    public function edit(Job $job)
    {
        return view('dashboard.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time',
            'work_mode' => 'required|in:hybrid,on-site',
            'location' => 'required|string|max:255',
        ]);

        $job->update($validated);
        return redirect()->route('jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
}
