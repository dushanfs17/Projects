<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::all();
        return view('dashboard.industries.index', compact('industries'));
    }

    public function create()
    {
        return view('dashboard.industries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'icon' => 'required|url|max:255',
        ]);

        Industry::create($validated);
        return redirect()->route('industries.index')->with('success', 'Industry created successfully!');
    }

    public function edit(Industry $industry)
    {
        return view('dashboard.industries.edit', compact('industry'));
    }

    public function update(Request $request, Industry $industry)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'icon' => 'required|url|max:255',
        ]);

        $industry->update($validated);
        return redirect()->route('industries.index')->with('success', 'Industry updated successfully!');
    }

    public function destroy(Industry $industry)
    {
        $industry->delete();
        return redirect()->route('industries.index')->with('success', 'Industry deleted successfully!');
    }
}
