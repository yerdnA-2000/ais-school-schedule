<?php

namespace App\Http\Controllers\Schedule\Make;

use App\Http\Controllers\Controller;
use App\Models\references\ClassEdu;
use App\Models\references\Staff;
use App\Models\references\Subject;
use App\Models\Schedule\Schedule;
use App\Models\Schedule\Workload;
use Illuminate\Http\Request;

class WorkloadController extends Controller
{
    public function index($id) {
        return view('schedules.make.workload.index', $this->getCompact($id));
    }

    public function indexUpdate($id) {
        return view('schedules.make.workload.data_table', $this->getCompact($id));
    }

    private function getCompact($id) {
        $sch = Schedule::with('distribution', 'term')->find($id);
        $dist = $sch->distribution;
        $workloads = Workload::with('staff', 'subject', 'class')->where('distribution_id', $dist->id)
            ->orderBy('staff_id')->get();
        $classes = ClassEdu::orderBy('title')->get()->pluck('title', 'id');
        $staffs = Staff::orderBy('name')->get()->pluck('name', 'id');
        $subjects = Subject::orderBy('title')->get()->pluck('title', 'id');
        return compact('workloads', 'classes', 'staffs', 'subjects', 'sch', 'dist');
    }

    public function store($distId, Request $request) {
        try {
            Workload::create(['staff_id'=>$request->staffId, 'subject_id'=>$request->subjectId,
                'class_id'=>$request->classId, 'week_hours'=>$request->weekHours, 'distribution_id'=>$distId]);
            return response()->json(['message' => 'success']);
        }
        catch (\Throwable $e) {
            return response()->json(['message'=>'error', 'result'=>$e]);
        }
    }
}
