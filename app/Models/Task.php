<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'title', 'due_date'];

    // Accessors

    public function getPriorityAttribute()
    {
        return ($this->due_date) ? 'High' : 'Low';
    }

    // Relationships

    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class);
    }
}
    