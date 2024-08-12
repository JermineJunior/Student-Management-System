<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch(Builder $query, Request $request)
    {
        return $query->when($request->search, function ($query) use ($request) {
            return $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        });
    }
}
