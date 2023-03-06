<?php

namespace App\Http\Controllers\References;

use App\Http\Controllers\Controller;
use App\Models\references\ProfileEducation;
use Illuminate\Http\Request;

class ProfileEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = ProfileEducation::orderBy('title')->get();
        return view('references.profiles.index', compact('profiles'));
    }

    public function indexAjax() {
        $profiles = ProfileEducation::orderBy('title')->paginate();
        return view('references.profiles.index_ajax', compact('profiles'));
    }

    public function sort(Request $request) {
        $type = $request->get('type');
        $status = $request->get('status');
        switch ($type) {
            case 'title':
                if ($status == 0) {
                    $profiles = ProfileEducation::orderByDesc('title')->paginate();
                } else {
                    $profiles = ProfileEducation::orderBy('title')->paginate();
                }
                break;
            case 'short_title':
                if ($status == 0) {
                    $profiles = ProfileEducation::orderByDesc('short_title')->paginate();
                } else {
                    $profiles = ProfileEducation::orderBy('short_title')->paginate();
                }
                break;
        }

        return view('references.profiles.index_ajax', compact('profiles'));
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
            ProfileEducation::create($data);
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
        $profile = ProfileEducation::find($id);
        return view('references.profiles.edit', compact('profile'));
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
        $profile = ProfileEducation::find($id);
        try {
            $profile->update($data, ['touch' => false]);
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
            ProfileEducation::find($id)->delete();
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка удаления!']);
        }
        return response()->json(['success'=>'success']);
    }
}
