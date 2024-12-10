<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $serviceCategories = ServiceCategory::all();
        return view('dashboard.service-categories.index', compact('serviceCategories'));
    }

    public function create()
    {
        return view('dashboard.service-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ServiceCategory::create($validated);
        return redirect()->route('service-categories.index')->with('success', 'Service category created successfully!');
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        return view('dashboard.service-categories.edit', compact('serviceCategory'));
    }

    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $serviceCategory->update($validated);
        return redirect()->route('service-categories.index')->with('success', 'Service category updated successfully!');
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();
        return redirect()->route('service-categories.index')->with('success', 'Service category deleted successfully!');
    }
}
