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
        $exParent = Parents::where('parent_name', '=', $data['parent_name'])->get();
        $id = $exParent[0]->id;
        if ($id) {
            return $id;
        } //creating a new parent
        $newParent = Parents::create($data);
        return $newParent->id;
    }
}
