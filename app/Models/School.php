<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\SchoolObserver;
use App\Models\Teacher;

class School extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "status"];

    public function active()
    {
       return $this->status == 1 ; //bool
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
