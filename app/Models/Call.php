<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'calls';

    protected $fillable = [
        'number',
        'start_time',
        'end_time',
    ];

    public function getTime($type) {
        switch ($type) {
            case 'start':
                return Carbon::createFromFormat('H:i:s', $this->start_time)->format('H:i');
            case  'end':
                return Carbon::createFromFormat('H:i:s', $this->end_time)->format('H:i');
        }
    }

}
