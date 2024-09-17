<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function students()
    {
        return $this->hasMany(Student::class, 'parent_id');
    }

    public static function createOrUpdate($data = [])
    {
        //finding a matching existing parent
        $exParent = Parents::where('parent_name', '=', $data['parent_name'])->first();

        if($exParent) {
             return $exParent->id;
         }

         $newParent = Parents::create($data);
         return $newParent->id;
    }
}
