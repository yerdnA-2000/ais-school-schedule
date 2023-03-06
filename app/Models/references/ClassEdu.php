<?php

namespace App\Models\references;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassEdu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'classes';

    protected $fillable = [
        'title',
        'head_id',
        'year'
    ];

    public function head(){
        return $this->belongsTo(Staff::class, 'head_id');
    }
}
