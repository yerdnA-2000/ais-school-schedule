<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Schedule\Schedule;
use App\Models\Term;
use Illuminate\Http\Request;

class DraftScheduleController extends Controller
{
    public function index() {
        $drafts = Schedule::with('term')->where('is_draft', '=', '1')
            ->orderByDesc('updated_at')->get();
        $countDrafts = $drafts->count();
        return view('schedules.draft.index', compact('drafts', 'countDrafts'));
    }

    public function store(Request $request) {
        try {
            $term = Term::where('academic_year_id', $request->yearId)->where('number', $request->number)->first();
            $sch = Schedule::create(['term_id'=>$term->id, 'is_draft'=>1, 'step_id'=>1]);
            return response()->json(['message' => 'success', 'schId'=>$sch->id]);
        }
        catch (\Throwable $e) {
            return response()->json(['message'=>'Ошибка!'.$e]);
        }
    }
}
