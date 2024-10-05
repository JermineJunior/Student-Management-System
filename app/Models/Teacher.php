<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['school_id' , 'name' , 'email' , 'phone' , ''];

    public function school()
    {
        return $this->belongsTo(School::class , 'school_id');
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
