<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'action'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
