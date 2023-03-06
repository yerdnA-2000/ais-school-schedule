<?php

namespace App\Models\references;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'cabinets';

    protected $fillable = [
        'title',
        'profile_id',
        'building_id',
        'is_schedule'
    ];

    public function profile(){
        return $this->belongsTo(ProfileEducation::class, 'profile_id');
    }

    public function building(){
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function staffs() {
        return $this->belongsToMany(Staff::class, 'staff_cabinet');
    }
}
