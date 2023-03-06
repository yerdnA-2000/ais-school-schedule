<?php

namespace App\Models\references;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileEducation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'profiles';

    protected $fillable = [
        'title',
        'short_title'
    ];

    public function cabinets(){
        return $this->hasMany(Cabinet::class);
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
    }
}
