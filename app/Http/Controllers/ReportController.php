<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentUser = Auth::user();
        $currentDate = Carbon::now()->format('Y-m-d H:i');
        switch ($id) {
            case 1:
                $items = Task::with('executor', 'author')
                    ->select(Task::raw('executor_id, COUNT(*) as countTotal,
                    COUNT(IF(status_id = 5, 1, NULL)) as countExecuted, 
                    COUNT(IF(status_id = 5 AND end_date <= finish, 1, NULL)) as countExecutedOnTime, 
                    COUNT(IF(status_id = 5 AND end_date > finish, 1, NULL)) as countExecutedNotOnTime, 
                    COUNT(IF(status_id = 1 OR status_id = 2, 1, NULL)) as countNotExecuted,
                    COUNT(IF(status_id = 1 AND finish < "'.$currentDate.'" , 1, NULL)) as countNotExecutedNotOnTime'))
                    /*->where('author_id', $currentUser->id)
                    ->where('executor_id', '!=', $currentUser->id)*/
                    ->groupBy('executor_id')
                    ->paginate();

                return view('reports.discipline', compact('items'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
