<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Partner;
use App\Models\Industry;


class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('dashboard.partners.index', compact('partners'));
    }

    public function create()
    {
        $industries = Industry::all();
        return view('dashboard.partners.create', compact('industries'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'industry_id' => 'required|exists:industries,id',
            'logo' => 'required|url|max:255',
            'collaboration_description' => 'required|string|max:255',
        ]);
        Partner::create($validated);
        return redirect()->route('partners.index')->with('success', 'Partner created successfully!');
    }

    public function edit(Partner $partner)
    {
        $industries = Industry::all(); // Fetch all industries
        return view('dashboard.partners.edit', compact('partner', 'industries'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'industry_id' => 'required|exists:industries,id',
            'logo' => 'required|url|max:255',
            'collaboration_description' => 'required|string|max:255',
        ]);

        $partner->update($validated);
        return redirect()->route('partners.index')->with('success', 'Partner updated successfully!');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo && file_exists(public_path('uploads/images/' . $partner->logo))) {
            unlink(public_path('uploads/images/' . $partner->logo));
        }

        $partner->delete();

        return redirect()->route('partners.index')->with('success', 'Partner deleted successfully!');
    }
}
