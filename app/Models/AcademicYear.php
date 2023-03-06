<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'academic_years';

    protected $fillable = [
        'id',
        'start_date',
        'finish_date',
    ];

    public function terms() {
        return $this->hasMany(Term::class);
    }

    public function getHumanAcademicYear() {
        return substr_replace((string)$this->id, "/", 4, 0);
    }
}
