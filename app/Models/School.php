<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\SchoolStatus;
use App\Models\Teacher;

class School extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "status"];

    // deactivated all schools when activating one
    public static function boot()
    {
        parent::boot();

        static::updating(function (School $school) {
            School::where("id", "!=", $school->id)->update([
                "status" => SchoolStatus::IN_ACTIVE,
            ]);
        });
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
