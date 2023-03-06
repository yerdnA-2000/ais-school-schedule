<?php

namespace App\Http\Controllers\References;

use App\Http\Controllers\Controller;
use App\Models\references\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::orderBy('title')->paginate();
        return view('references.positions.index', compact('positions'));
    }

    public function indexAjax() {
        $positions = Position::orderBy('title')->paginate();
        return view('references.positions.index_ajax', compact('positions'));
    }

    public function sort(Request $request) {
        $type = $request->get('type');
        $status = $request->get('status');
        switch ($type) {
            case 'title':
                if ($status == 0) {
                    $positions = Position::orderByDesc('title')->paginate();
                } else {
                    $positions = Position::orderBy('title')->paginate();
                }
                break;
            case 'short_title':
                if ($status == 0) {
                    $positions = Position::orderByDesc('short_title')->paginate();
                } else {
                    $positions = Position::orderBy('short_title')->paginate();
                }
                break;
        }

        return view('references.positions.index_ajax', compact('positions'));
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
            'short_title' => 'required',
        ]);
        $title = $request->input('title');
        $short_title = $request->input('short_title');

        $data = ['title' => $title, 'short_title' => $short_title];
        try {
            Position::create($data);
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
        $position = Position::find($id);
        return view('references.positions.edit', compact('position'));
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
            'short_title' => 'required',
        ]);
        $title = $request->input('title');
        $short_title = $request->input('short_title');

        $data = ['title' => $title, 'short_title' => $short_title];
        $position = Position::find($id);
        try {
            $position->update($data, ['touch' => false]);
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
            Position::find($id)->delete();
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка удаления!']);
        }
        return response()->json(['success'=>'success']);
    }
}
