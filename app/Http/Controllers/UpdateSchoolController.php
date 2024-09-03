<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class UpdateSchoolController extends Controller
{
    public function update(School $school)
    {
        //activate the school
        $school->update(['status' => 1]);

        return redirect()->route('dashboard');
    }
}
