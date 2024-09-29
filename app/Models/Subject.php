<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'full_mark', 'class_id'];

    public function classRoom()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
