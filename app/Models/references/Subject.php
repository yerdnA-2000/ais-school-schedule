<?php

namespace App\Models\references;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'subjects';

    protected $fillable = [
        'title',
        'short_title',
        'profile_id',
        'hard1_4', 'hard5', 'hard6', 'hard7', 'hard8', 'hard9', 'hard10_11'
    ];

    public function profile(){
        return $this->belongsTo(ProfileEducation::class, 'profile_id');
    }

    public function staffs() {
        return $this->belongsToMany(Staff::class, 'staff_subject');
    }
}
