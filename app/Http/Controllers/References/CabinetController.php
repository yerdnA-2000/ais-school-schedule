<?php

namespace App\Http\Controllers\References;

use App\Http\Controllers\Controller;
use App\Models\references\Building;
use App\Models\references\Cabinet;
use App\Models\references\ProfileEducation;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabinets = Cabinet::with('building', 'profile')->orderByDesc('title')->paginate();
        $profiles = ProfileEducation::pluck('short_title', 'id')->all();
        $buildings = Building::pluck('title', 'id')->all();
        return view('references.cabinets.index', compact('cabinets', 'profiles', 'buildings'));
    }

    public function indexAjax() {
        $cabinets = Cabinet::with('building', 'profile')->orderByDesc('title')->paginate();
        return view('references.cabinets.index_ajax', compact('cabinets'));
    }

    public function sort(Request $request) {
        $type = $request->get('type');
        $status = $request->get('status');
        switch ($type) {
            case 'title':
                if ($status == 0) {
                    $cabinets = Cabinet::with('building', 'profile')->orderBy('title')->paginate();
                } else {
                    $cabinets = Cabinet::with('building', 'profile')->orderByDesc('title')->paginate();
                }
                break;
            case 'profile':
                if ($status == 0) {
                    $cabinets = Cabinet::with('building', 'profile')
                        ->orderBy('profile_id')->paginate();
                } else {
                    $cabinets = Cabinet::with('building', 'profile')
                        ->orderByDesc('profile_id')->paginate();
                }
                break;
            case 'building':
                if ($status == 0) {
                    $cabinets = Cabinet::with('building', 'profile')
                        ->orderBy('building_id')->paginate();
                } else {
                    $cabinets = Cabinet::with('building', 'profile')
                        ->orderByDesc('building_id')->paginate();
                }
                break;
            case 'is_schedule':
                if ($status == 0) {
                    $cabinets = Cabinet::with('building', 'profile')
                        ->orderBy('is_schedule')->paginate();
                } else {
                    $cabinets = Cabinet::with('building', 'profile')
                        ->orderByDesc('is_schedule')->paginate();
                }
                break;
        }

        return view('references.cabinets.index_ajax', compact('cabinets'));
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'profile' => 'required|integer',
            'building' => 'required|integer',
        ]);
        if ($request->has('is_schedule')) {
            $is_schedule = 1;
        } else {
            $is_schedule = 0;
        }
        $title = $request->input('title');
        $profile_id = $request->input('profile');
        $building_id = $request->input('building');

        $data = ['title' => $title, 'profile_id' => $profile_id,
            'building_id' => $building_id, 'is_schedule' => $is_schedule];
        try {
            Cabinet::create($data);
            return response()->json(['success'=>'success']);
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка добавления!']);
        }

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
        $cabinet = Cabinet::find($id);
        $profiles = ProfileEducation::pluck('short_title', 'id')->all();
        $buildings = Building::pluck('title', 'id')->all();
        return view('references.cabinets.edit', compact('cabinet', 'profiles', 'buildings'));
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
            'profile' => 'required|integer',
            'building' => 'required|integer'
        ]);
        if ($request->has('is_schedule')) {
            $is_schedule = 1;
        } else {
            $is_schedule = 0;
        }
        $title = $request->input('title');
        $profile_id = $request->input('profile');
        $building_id = $request->input('building');

        $data = ['title' => $title, 'profile_id' => $profile_id,
            'building_id' => $building_id, 'is_schedule' => $is_schedule];
        $cabinet = Cabinet::find($id);
        try {
            $cabinet->update($data, ['touch' => false]);
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
            Cabinet::find($id)->delete();
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка удаления!']);
        }
        return response()->json(['success'=>'success']);
    }
}
