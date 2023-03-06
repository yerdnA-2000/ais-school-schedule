<?php

namespace App\Models\references;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'buildings';

    protected $fillable = [
        'title',
        'is_schedule',
    ];

    public function cabinets(){
        return $this->hasMany(Cabinet::class);
    }
}
