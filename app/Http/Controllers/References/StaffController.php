<?php

namespace App\Http\Controllers\References;

use App\Http\Controllers\Controller;
use App\Models\references\Position;
use App\Models\references\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::with('positions')->orderBy('name')->get();
        $positions = Position::pluck('short_title', 'id')->all();
        return view('references.staffs.index', compact('staffs', 'positions'));
    }

    public function indexAjax() {
        $staffs = Staff::with('positions')->orderBy('name')->get();
        $positions = Position::pluck('short_title', 'id')->all();
        return view('references.staffs.index_ajax', compact('staffs', 'positions'));
    }

    public function showAjax($id) {
        $staff = Staff::find($id);
        $positions = Position::pluck('short_title', 'id')->all();
        return view('references.staffs.index_show', compact('staff', 'positions'));
    }

    public function sort(Request $request) {
        $type = $request->get('type');
        $status = $request->get('status');
        switch ($type) {
            case 'name':
                if ($status == 0) {
                    $staffs = Staff::with('positions')->orderByDesc('name')->paginate();
                } else {
                    $staffs = Staff::with('positions')->orderBy('name')->paginate();
                }
                break;
            case 'short_name':
                if ($status == 0) {
                    $staffs = Staff::with('positions')->orderByDesc('short_name')->paginate();
                } else {
                    $staffs = Staff::with('positions')->orderBy('short_name')->paginate();
                }
                break;
            case 'position':
                if ($status == 0) {
                    $staffs = Staff::with(array('positions' => function($query) {
                        $query->orderBy('title', 'DESC');
                    }))->orderByDesc('name')->paginate();
                } else {
                    $staffs = Staff::with(array('positions' => function($query) {
                        $query->orderBy('title', 'ASC');
                    }))->orderByDesc('name')->paginate();
                }
                break;
        }
        return view('references.staffs.index_ajax', compact('staffs'));
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
            'name' => 'required',
            'short_name' => 'required',
            'positions' => 'required',
        ]);
        $name = $request->input('name');
        $short_name = $request->input('short_name');
        $positions = $request->input('positions');

        $data = ['name' => $name, 'short_name' => $short_name];
        try {
            $staff = Staff::create($data);
            $staff->positions()->sync($positions);
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
        $staff = Staff::find($id);
        $positions = Position::pluck('short_title', 'id')->all();
        return view('references.staffs.edit', compact('staff', 'positions'));
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
            'name' => 'required',
            'short_name' => 'required',
            'positions' => 'required',
        ]);
        $name = $request->input('name');
        $short_name = $request->input('short_name');
        $positions = $request->input('positions');

        $data = ['name' => $name, 'short_name' => $short_name];
        $staff = Staff::find($id);
        try {
            $staff->update($data, ['touch' => false]);
            $staff->positions()->sync($positions);
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
            Staff::find($id)->delete();
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка удаления!']);
        }
        return response()->json(['success'=>'success']);
    }
}
