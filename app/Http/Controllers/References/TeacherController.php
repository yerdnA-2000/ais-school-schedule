<?php

namespace App\Http\Controllers\References;

use App\Http\Controllers\Controller;
use App\Models\references\Staff;
use App\Models\references\Subject;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Staff::with('subjects')->orderBy('short_name')->get();
        $subjects = Subject::pluck('short_title', 'id')->all();
        $staffs = Staff::orderBy('short_name')->pluck('short_name', 'id')->all();
        return view('references.teachers.index', compact('teachers', 'subjects', 'staffs'));
    }

    public function indexAjax() {
        $teachers = Staff::with('subjects')->orderBy('short_name')->get();
        $subjects = Subject::pluck('short_title', 'id')->all();
        $staffs = Staff::orderBy('short_name')->pluck('short_name', 'id')->all();
        return view('references.teachers.index_ajax', compact('teachers', 'subjects', 'staffs'));
    }

    public function sort(Request $request) {
        $type = $request->get('type');
        $status = $request->get('status');
        switch ($type) {
            case 'short_name':
                if ($status == 0) {
                    $staffs = Staff::with('subjects')->orderByDesc('short_name')->paginate();
                } else {
                    $staffs = Staff::with('subjects')->orderBy('short_name')->paginate();
                }
                break;
            case 'position':
                if ($status == 0) {
                    $staffs = Staff::with(array('subjects' => function($query) {
                        $query->orderBy('short_title', 'DESC');
                    }))->orderByDesc('short_name')->paginate();
                } else {
                    $staffs = Staff::with(array('subjects' => function($query) {
                        $query->orderBy('short_title', 'ASC');
                    }))->orderByDesc('short_name')->paginate();
                }
                break;
        }
        return view('references.teachers.index_ajax', compact('teachers'));
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
        $request->validate([
            'staff' => 'required',
            'subjects' => 'required',
        ]);
        $staff_id = $request->input('staff');
        $subjects = $request->input('subjects');

        try {
            $staff = Staff::find($staff_id);
            $staff->subjects()->sync($subjects);
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка добавления!']);
        }
        return response()->json(['success'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Staff::find($id);

        $subjects = Subject::pluck('short_title', 'id')->all();
        return view('references.teachers.edit', compact('teacher', 'subjects'));
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
        $request->validate([
            'staff' => 'required',
            'subjects' => 'required',
        ]);
        $staff_id = $request->input('staff');
        $subjects = $request->input('subjects');

        try {
            $staff = Staff::find($staff_id);
            $staff->subjects()->sync($subjects);
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка редактирования!']);
        }
        return response()->json(['success'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $staff = Staff::find($id);
            $staff->subjects()->detach();
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка удаления!']);
        }
        return response()->json(['success'=>'success']);
    }
}
