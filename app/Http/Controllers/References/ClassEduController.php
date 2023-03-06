<?php

namespace App\Http\Controllers\References;

use App\Http\Controllers\Controller;
use App\Models\references\ClassEdu;
use App\Models\references\Staff;
use Illuminate\Http\Request;

class ClassEduController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = ClassEdu::with('head')->orderBy('year')->orderBy('title')->paginate();
        $staffs = Staff::pluck('short_name', 'id')->all();
        return view('references.classes.index', compact('classes', 'staffs'));
    }

    public function indexAjax() {
        $classes = ClassEdu::with('head')->orderBy('year')->orderBy('title')->paginate();
        $staffs = Staff::pluck('short_name', 'id')->all();
        return view('references.classes.index_ajax', compact('classes', 'staffs'));
    }

    public function sort(Request $request) {
        $type = $request->get('type');
        $status = $request->get('status');
        switch ($type) {
            case 'title':
                if ($status == 0) {
                    $classes = ClassEdu::with('head')->orderByDesc('title')->paginate();
                } else {
                    $classes = ClassEdu::with('head')->orderBy('title')->paginate();
                }
                break;
            case 'year':
                if ($status == 0) {
                    $classes = ClassEdu::with('head')->orderByDesc('year')->paginate();
                } else {
                    $classes = ClassEdu::with('head')->orderBy('year')->paginate();
                }
                break;
            case 'head':
                if ($status == 0) {
                    $classes = ClassEdu::with('head')->orderByDesc('head_id')->paginate();
                } else {
                    $classes = ClassEdu::with('head')->orderBy('head_id')->paginate();
                }
                break;
        }
        return view('references.classes.index_ajax', compact('classes'));
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
            'title' => 'required',
            'head' => 'required|integer',
            'year' => 'required',
        ]);
        $title = $request->input('title');
        $head_id = $request->input('head');
        $year = $request->input('year');

        $data = ['title' => $title, 'head_id' => $head_id, 'year' => $year];
        try {
            ClassEdu::create($data);
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
        $class = ClassEdu::find($id);
        $staffs = Staff::pluck('short_name', 'id')->all();
        return view('references.classes.edit', compact('class', 'staffs'));
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
            'title' => 'required',
            'head' => 'required|integer',
            'year' => 'required',
        ]);
        $title = $request->input('title');
        $head_id = $request->input('head');
        $year = $request->input('year');

        $data = ['title' => $title, 'head_id' => $head_id, 'year' => $year];
        $class = ClassEdu::find($id);
        try {
            $class->update($data, ['touch' => false]);
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка редактирования!']);
        }
        return response()->json(['success'=>'success'.$year]);
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
            ClassEdu::find($id)->delete();
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка удаления!']);
        }
        return response()->json(['success'=>'success']);
    }
}
