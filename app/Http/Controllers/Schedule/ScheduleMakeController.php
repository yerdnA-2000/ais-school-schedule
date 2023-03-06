<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Term;
use Illuminate\Http\Request;

class ScheduleMakeController extends Controller
{
    public function index() {
        $academicYears = AcademicYear::select('id')->orderBy('id')->get()->pluck('id');
        $numbersTerm = [1, 2, 3, 4];
        return view('schedules.make.index', compact('academicYears', 'numbersTerm'));
    }

    public function getDatesTermAjax(Request $request) {
        $term = Term::where('academic_year_id', $request->yearId)->where('number', $request->number)->first();
        $startDate = $term->start_date;
        $finishDate = $term->finish_date;
        /*return compact('startDate', 'finishDate');*/
        return response()->json(['startDate'=>$startDate, 'finishDate' => $finishDate]);
        /*return view('schedules.make.forms.term_dates', compact('startDate', 'finishDate'));*/
    }

    public function updateDatesTermAjax(Request $request) {
        try {
            $term = Term::where('academic_year_id', $request->yearId)->where('number', $request->number)->first()
                ->update(['start_date' => $request->startDate, 'finish_date' => $request->finishDate]);
            return response()->json(['success' => 'Успешно!']);
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка!'.$e]);
        }

    }
}
