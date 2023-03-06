<?php

namespace App\Http\Controllers\Schedule\Make;

use App\Http\Controllers\Controller;
use App\Models\Schedule\Schedule;
use App\Models\Schedule\WorkloadsDistribution;
use Illuminate\Http\Request;

class WorkloadsDistributionController extends Controller
{
    public function index($id) {
        $schId = $id;
        $termId = Schedule::find($id)->term_id;
        $distributions = WorkloadsDistribution::with('term', 'academicYear')->where('term_id', $termId)
            ->orderByDesc('updated_at')->get();
        return view('schedules.make.distribution.index',
            compact('distributions', 'termId', 'schId'));
    }

    public function indexUpdate($id) {
        $schId = $id;
        $termId = Schedule::find($id)->term_id;
        $distributions = WorkloadsDistribution::with('term')->where('term_id', $termId)
            ->orderByDesc('updated_at')->get();
        return view('schedules.make.distribution.data_table',
            compact('distributions', 'termId', 'schId'));
    }

    public function store(Request $request) {
        try {
            WorkloadsDistribution::create(['term_id'=>$request->termId]);
            return response()->json(['message' => 'success']);
        }
        catch (\Throwable $e) {
            return response()->json(['message'=>'error', 'result'=>$e]);
        }
    }

    public function approp(Request $request) {
        try {
            $request->validate([
                'schId' => 'required|integer',
                'distId' => 'required|integer',
            ]);
            $sch = Schedule::with('distribution')->find($request->schId);
            $sch->update(['step_id'=>2, 'distribution_id' => $request->distId]);
            return response()->json(['message' => 'success']);
        }
        catch (\Throwable $e) {
            return response()->json(['message'=>'error', 'result'=>$e]);
        }
    }
}
