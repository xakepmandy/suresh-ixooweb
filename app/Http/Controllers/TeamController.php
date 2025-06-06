<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display the team members
        $teams = Team::all();
        return view('admin.team.index', compact('teams'));
    }

    public function create()
    {
        // Logic to show the form for creating a new team member
        return view('admin.team.create');
    }
    public function store(Request $request)
    {
        // Logic to store a new team member
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'position' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/team'), $imageName);
            $data['image'] = $imageName;
        }

        Team::create($data);
        return redirect()->route('admin.team')->with('success', 'Team member created successfully.');
    }
    public function edit($id)
    {
        // Logic to show the form for editing a team member
        $team = Team::findOrFail($id);
        return view('admin.team.edit', compact('team'));
    }
    public function update(Request $request, $id)
    {
        // Logic to update a team member
        $team = Team::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'position' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/team'), $imageName);
            $data['image'] = $imageName;
        } else {
            
            $data['image'] = $team->image;
        }
        $team->update($data);

        return redirect()->route('admin.team')->with('success', 'Team member updated successfully.');
    }
    public function delete($id)
    {
        // Logic to delete a team member
        $team = Team::findOrFail($id);
        if ($team->image) {
            $imagePath = public_path('uploads/team/' . $team->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $team->delete();
        return redirect()->route('admin.team')->with('success', 'Team member deleted successfully.');
    }
    public function status(Request $request)
    {
        // Logic to toggle the status of a team member
        $team = Team::findOrFail($request->id);
        // dd($team);
        $team->status = $team->status === 'Active' ? 'inactive' : 'active';
        $team->save();
        return response()->json([
            'message' => 'Team member status updated successfully.'
        ]);
    }
}
