<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryTask extends Model
{
    use HasFactory;

    protected $table = 'stories_tasks';

    protected $fillable = [
        'task_id',
        'author_id',
        'where_changed',
        'last_value',
        'current_value',
    ];

    public function task() {
        return $this->belongsTo(Task::class);
    }

    public function author() {
        return $this->belongsTo(User::class);
    }

    public function getDate() {
        $formatter = new \IntlDateFormatter('ru_RU',  \IntlDateFormatter::FULL,
            \IntlDateFormatter::FULL);
        $formatter->setPattern('d MMMM, H:mm');
        return $formatter->format(new  \DateTime($this->created_at));
    }
}
