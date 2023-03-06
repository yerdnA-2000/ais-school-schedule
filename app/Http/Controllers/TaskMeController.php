<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TaskMeController extends Controller
{
    public function index() {
        return view('tasks.tasks_me.index');
    }

    public function show() {
        return view('tasks.tasks_me.show');
    }
}
