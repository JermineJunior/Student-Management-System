<?php

namespace App\Observers;

use App\Models\School;
use App\SchoolStatus;

class SchoolObserver
{

    public function creating(School $school)
    {
        //deactivate the current active school
        School::where("status", "=", 1)->update([
            "status" => SchoolStatus::IN_ACTIVE,
        ]);
        //activate the newly added school
        $school->status  = 1;
    }

    public function updating(School $school)
    {
        if($school->active()){
            //only deactivate the active school
            School::where("status", "=", 1)->update([
                "status" => SchoolStatus::IN_ACTIVE,
            ]);
        }
    }

    public function deleting(School $school)
    {
        if($school->active()){
            //find the latest school
            $latestSchool = School::where('id' , '!=' ,$school->id)
                            ->orderBy('created_at' , 'desc')->first();
            // activate the latest school
            if ($latestSchool) {
                $latestSchool->update(['status' => 1]);
            }
        }
    }
}
