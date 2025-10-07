<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
        protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'creator_id',
    ];
    protected $casts = [
    'start_date' => 'date',
    'end_date' => 'date',
];
public function tasks()
{
    return $this->hasMany(Task::class, 'project_id');
}
}