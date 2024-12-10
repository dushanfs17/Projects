<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Industry;
use App\Models\ServiceCategory;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('dashboard.services.index', compact('services'));
    }

    public function create()
    {
        $industries = Industry::all();
        $serviceCategories = ServiceCategory::all();
        return view('dashboard.services.create', compact('industries', 'serviceCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'service_category_id' => 'required|exists:service_categories,id',
            'industry_id' => 'required|exists:industries,id',
        ]);

        Service::create($validated);
        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }

    public function edit(Service $service)
    {
        $industries = Industry::all();
        $serviceCategories = ServiceCategory::all();
        return view('dashboard.services.edit', compact('service', 'industries', 'serviceCategories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'service_category_id' => 'required|exists:service_categories,id',
            'industry_id' => 'required|exists:industries,id',
        ]);

        $service->update($validated);
        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }
}
