<?php

namespace App\Models\Schedule;

use App\Models\references\ClassEdu;
use App\Models\references\Staff;
use App\Models\references\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workload extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'workloads';

    protected $fillable = [
        'distribution_id',
        'staff_id',
        'subject_id',
        'class_id',
        'week_hours',
    ];

    public function distribution() {
        return $this->belongsTo(WorkloadsDistribution::class, 'distribution_id');
    }

    public function staff() {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function class() {
        return $this->belongsTo(ClassEdu::class, 'class_id');
    }
}
