<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    // accessors
    public function getImagePathAttribute()
    {
        if( is_null($this->image) ) {
            return null;
        }

        return asset('storage/' . $this->image);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\Project::class);
    }

    public function tasks()
    {
        return $this->hasMany(\App\Models\Task::class);
    }
}
