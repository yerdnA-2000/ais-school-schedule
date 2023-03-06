<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleCurrentController extends Controller
{
    public function index() {
        return view('schedules.current.index');
    }
}
