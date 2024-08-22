<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = SubjectResource::collection(Subject::orderBy('class_id', 'asc')->get());
        return inertia('Subjects/Index', ['subjects' => $subjects]);
    }

    public function create()
    {
     //render the create page   
    }
}
