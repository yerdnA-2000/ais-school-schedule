<?php

namespace App\Http\Controllers\References;

use App\Http\Controllers\Controller;
use App\Models\references\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Building::all();
        return view('references.buildings.index', compact('buildings'));
    }

    public function indexAjax() {
        $buildings = Building::all();
        return view('references.buildings.index_ajax', compact('buildings'));
    }

    public function sort(Request $request) {
        $type = $request->get('type');
        $status = $request->get('status');
        switch ($type) {
            case 'title':
                if ($status == 0) {
                    $buildings = Building::orderBy('title')->paginate();
                } else {
                    $buildings = Building::orderByDesc('title')->paginate();
                }
                break;
            case 'is_schedule':
                if ($status == 0) {
                    $buildings = Building::orderBy('is_schedule')->paginate();
                } else {
                    $buildings = Building::orderByDesc('is_schedule')->paginate();
                }
                break;
        }

        return view('references.buildings.index_ajax', compact('buildings'));
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
        ]);
        if ($request->has('is_schedule')) {
            $is_schedule = 1;
        } else {
            $is_schedule = 0;
        }
        $title = $request->input('title');

        $data = ['title' => $title, 'is_schedule' => $is_schedule];
        try {
            Building::create($data);
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
        $building = Building::find($id);
        return view('references.buildings.edit', compact('building'));
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
        ]);
        if ($request->has('is_schedule')) {
            $is_schedule = 1;
        } else {
            $is_schedule = 0;
        }
        $title = $request->input('title');

        $data = ['title' => $title, 'is_schedule' => $is_schedule];

        $building = Building::find($id);
        $building->update($data, ['touch' => false]);

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
        Building::find($id)->delete();
        return response()->json(['success'=>'success']);
    }
}
