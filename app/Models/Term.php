<?php

namespace App\Models;

use App\Models\Schedule\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'terms';

    protected $fillable = [
        'academic_year_id',
        'number',
        'start_date',
        'finish_date',
    ];

    public function academicYear() {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }
}
