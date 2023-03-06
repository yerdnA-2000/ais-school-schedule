<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTask extends Model
{
    use HasFactory;

    protected $table = 'statuses_tasks';

    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
