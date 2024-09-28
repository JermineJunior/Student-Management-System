<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\SchoolObserver;

class School extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "status"];

    public function active()
    {
       return $this->status == 1 ; //bool
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public static function activeSchool()
    {
        return School::where('status' , '=' , '1')->first();
    }
}
