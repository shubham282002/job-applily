<?php

namespace App\Http\Controllers;

use App\Models\MasterDescription;
use Illuminate\Http\Request;

class MasterDescriptionController extends Controller
{
    public function index()
    {
        $descriptions = MasterDescription::orderBy('type')->paginate(10);
        return view('masters.descriptions.index', compact('descriptions'));
    }

    public function create()
    {
        return view('masters.descriptions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        MasterDescription::create($validated);

        return redirect('/masters/descriptions')->with('success', 'Description Master created successfully!');
    }

    public function edit(MasterDescription $description)
    {
        return view('masters.descriptions.edit', compact('description'));
    }

    public function update(Request $request, MasterDescription $description)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $description->update($validated);

        return redirect('/masters/descriptions')->with('success', 'Description Master updated successfully!');
    }

    public function destroy(MasterDescription $description)
    {
        $description->delete();
        return redirect('/masters/descriptions')->with('success', 'Description Master deleted successfully!');
    }
}
