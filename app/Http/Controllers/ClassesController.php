<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassesResource;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = ClassesResource::collection(Classes::all());

        return inertia('Classes/Index', ['classes' => $classes]);
    }

    public function store()
    {
        $validatedDate = request()->validate(['name' => ['required', 'min:3']]);

        Classes::create($validatedDate);

        return redirect()->route('classes.index');
    }

    public function edit(Classes $class)
    {
        $Class =  ClassesResource::make($class);
        return inertia('Classes/Edit', ['Class' => $Class]);
    }
    public function destroy(Classes $class)
    {
        $class->delete();

        return redirect()->route('classes.index');
    }
}
