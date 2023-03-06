<?php

namespace App\Models\references;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'staffs';

    protected $fillable = [
        'name',
        'short_name'
    ];

    public function getBirthday() {
        $formatter = new \IntlDateFormatter('ru_RU',  \IntlDateFormatter::FULL,
            \IntlDateFormatter::FULL);
        $formatter->setPattern('d MMMM');
        return $formatter->format(new  \DateTime($this->birthday));
    }

    public function positions() {
        return $this->belongsToMany(Position::class, 'staff_position');
    }

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'staff_subject');
    }

    public function classEdu(){
        return $this->hasOne(ClassEdu::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'users');
    }

    public function cabinets() {
        return $this->belongsToMany(Cabinet::class, 'staff_cabinet');
    }
}
