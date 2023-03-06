<?php

namespace App\Models\Schedule;

use App\Models\AcademicYear;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkloadsDistribution extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'workloads_distribution';

    protected $fillable = [
        'term_id',
        'title',
    ];

    public function term() {
        return $this->belongsTo(Term::class);
    }

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }

    public function workloads() {
        return $this->hasMany(Workload::class);
    }

    public function academicYear() {
        return $this->hasOneThrough(AcademicYear::class, Term::class,
            'academic_year_id', 'id', 'id', 'academic_year_id');
    }

    public function getHumanCreatedAt() {;
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->timezone('Etc/UTC')->diffForHumans();
    }

    public function getHumanUpdatedAt() {;
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->timezone('Etc/UTC')->diffForHumans();
    }
}
