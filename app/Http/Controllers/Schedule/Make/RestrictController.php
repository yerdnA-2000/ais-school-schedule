<?php

namespace App\Http\Controllers\Schedule\Make;

use App\Http\Controllers\Controller;
use App\Models\references\ClassEdu;
use App\Models\references\Staff;
use App\Models\references\Subject;
use App\Models\Schedule\Schedule;
use App\Models\Schedule\Workload;
use Illuminate\Http\Request;

class RestrictController extends Controller
{
    public function index($id) {
        return view('schedules.make.restricts.index', $this->getCompact($id));
    }

    public function indexUpdate($id) {
        return view('schedules.make.restricts.data_table', $this->getCompact($id));
    }

    private function getCompact($id) {
        $sch = Schedule::with('distribution', 'term')->find($id);
        $dist = $sch->distribution;
        $workloads = Workload::with('staff', 'subject', 'class')->where('distribution_id', $dist->id)
            ->orderBy('staff_id')->get();
        $classes = ClassEdu::orderBy('title')->get()->pluck('title', 'id');
        $staffs = Staff::orderBy('name')->get()->pluck('name', 'id');
        $subjects = Subject::orderBy('title')->get()->pluck('title', 'id');
        $sch->update(['step_id'=>3]);
        $restricts[] = ['type'=>'Макс. нагрузка в день', 'desc'=>'Для (Малахова Т.А.) максимальное кол-во уроков в день (3)'];
        $restricts[] = ['type'=>'Методический день', 'desc'=>'Для (Федоренко Е.Ф.) не ставить уроки по (пт)'];
        $restricts[] = ['type'=>'Методический день', 'desc'=>'Для (Кацитадзе С.Д.) не ставить уроки по (ср)'];
        $restricts[] = ['type'=>'Физическая культура', 'desc'=>'На уроке физической культуры могут заниматься одновременно не более (3) классов'];
        /*dd($restricts);*/
        return compact('workloads', 'classes', 'staffs', 'subjects', 'sch', 'dist', 'restricts');
    }
}
