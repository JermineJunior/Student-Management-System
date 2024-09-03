<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    //deactivated all schools when activating one
    // public static function boot()
    // {
    //     parent::boot();

    //     static::updating(function (School $school) {
    //         if (in_array('status', array_keys($school->getDirty()))) {
    //             $school->all()->where('id', '!=', $school->id)->update(['status', 0]);
    //         }
    //     });
    // }
}
