<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('dashboard.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('dashboard.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'testimonial_text' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'client_position' => 'required|string|max:255',
            'client_company' => 'required|string|max:255',
            'client_profile_picture' => 'required|url|max:255',

        ]);

        Testimonial::create($validated);
        return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('dashboard.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'testimonial_text' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'client_position' => 'required|string|max:255',
            'client_company' => 'required|string|max:255',
            'client_profile_picture' => 'required|url|max:255',
        ]);

        $testimonial->update($validated);
        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }
}
