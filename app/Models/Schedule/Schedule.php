<?php

namespace App\Models\Schedule;

use App\Models\AcademicYear;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'schedule';

    protected $fillable = [
        'term_id',
        'is_draft',
        'step_id',
        'distribution_id',
    ];

    public function term() {
        return $this->belongsTo(Term::class, 'term_id');
    }

    public function academicYear() {
        return $this->hasOneThrough(AcademicYear::class, Term::class,
            'academic_year_id', 'id', 'id', 'academic_year_id');
    }

    public function distribution() {
        return $this->belongsTo(WorkloadsDistribution::class, 'distribution_id');
    }

    public function step() {
        return $this->belongsTo(Step::class);
    }


    public function getHumanCreatedAt() {;
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->timezone('Etc/UTC')->diffForHumans();
        /*return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('j F, H:i');*/
    }

    public function getHumanUpdatedAt() {;
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->timezone('Etc/UTC')->diffForHumans();
        /*return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('j F, H:i');*/
    }
}
