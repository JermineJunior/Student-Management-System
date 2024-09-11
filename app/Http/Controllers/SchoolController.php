<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:schools,name',
            'description' => 'nullable|string|max:1000',
        ]);

        School::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, School $school)
    {
        $school->update($request->only('name'));

        return redirect()->route('dashboard');
    }

    public function destroy(School $school)
    {
        $school->delete();

        return redirect()->route('dashboard');
    }
}
