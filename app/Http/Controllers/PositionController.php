<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        return view('dashboard.positions.index', compact('positions'));
    }

    public function create()
    {
        return view('dashboard.positions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Position::create($validated);
        return redirect()->route('positions.index')->with('success', 'Position created successfully!');
    }

    public function edit(Position $positions)
    {
        return view('dashboard.positions.edit', compact('positions'));
    }

    public function update(Request $request, Position $positions)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $positions->update($validated);
        return redirect()->route('positions.index')->with('success', 'Position updated successfully!');
    }

    public function destroy(Position $positions)
    {
        $positions->delete();
        return redirect()->route('service-categories.index')->with('success', 'Position deleted successfully!');
    }
}
