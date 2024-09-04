<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
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
