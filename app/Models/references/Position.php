<?php

namespace App\Models\references;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'positions';

    protected $fillable = [
        'title',
        'short_title'
    ];

    public function staffs() {
        return $this->belongsToMany(Staff::class, 'staff_position');
    }
}
