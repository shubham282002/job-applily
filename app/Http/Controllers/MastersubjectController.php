<?php

namespace App\Http\Controllers;

use App\Models\MasterSubject;
use Illuminate\Http\Request;

class MasterSubjectController extends Controller
{
    public function index()
    {
        $subjects = MasterSubject::orderBy('category')->paginate(10);
        return view('masters.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('masters.subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        MasterSubject::create($validated);

        return redirect('/masters/subjects')->with('success', 'Subject Master created successfully!');
    }

    public function edit(MasterSubject $subject)
    {
        return view('masters.subjects.edit', compact('subject'));
    }

    public function update(Request $request, MasterSubject $subject)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $subject->update($validated);

        return redirect('/masters/subjects')->with('success', 'Subject Master updated successfully!');
    }

    public function destroy(MasterSubject $subject)
    {
        $subject->delete();
        return redirect('/masters/subjects')->with('success', 'Subject Master deleted successfully!');
    }
}
