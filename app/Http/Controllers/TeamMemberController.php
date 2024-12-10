<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Models\Position;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::all();
        return view('dashboard.team-members.index', compact('teamMembers'));
    }

    public function create()
    {
        $positions = Position::all();
        return view('dashboard.team-members.create', compact('positions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'picture' => 'required|url|max:255',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'position_id' => 'required|exists:positions,id',
            'short_profile' => 'required|string|max:255',
        ]);

        TeamMember::create($validated);
        return redirect()->route('team-members.index')->with('success', 'Team member created successfully!');
    }

    public function edit(TeamMember $teamMember)
    {
        $positions = Position::all();
        return view('dashboard.team-members.edit', compact('teamMember', 'positions'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'picture' => 'required|url|max:255',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'position_id' => 'required|exists:positions,id',
            'short_profile' => 'required|string|max:255',
        ]);

        $teamMember->update($validated);
        return redirect()->route('team-members.index')->with('success', 'Team member updated successfully!');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();
        return redirect()->route('team-members.index')->with('success', 'Team member deleted successfully!');
    }
}
