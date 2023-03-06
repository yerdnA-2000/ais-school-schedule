<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'content',
        'executor_id',
        'start',
        'finish',
        'deadline',
        'previous_task_id',
        'status_id',
    ];

    public function executor() {
        return $this->belongsTo(User::class);
    }

    public function author() {
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(StatusTask::class);
    }

    public function stories() {
        return $this->hasMany(StoryTask::class);
    }


    public function getTaskDate($type) {
        $formatter = new \IntlDateFormatter('ru_RU',  \IntlDateFormatter::FULL,
            \IntlDateFormatter::FULL);
        $formatter->setPattern('d MMMM, H:m');
        switch ($type) {
            case 'start':
                return $formatter->format(new  \DateTime($this->start));
                /*return Carbon::createFromFormat('Y-m-d H:i:s', $this->start)->format('j F, H:i');*/
            case  'finish':
                return $formatter->format(new  \DateTime($this->finish));
            case  'deadline':
                return $formatter->format(new  \DateTime($this->deadline));
        }
    }

}
