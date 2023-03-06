<?php

namespace App\Http\Controllers\References;

use App\Http\Controllers\Controller;
use App\Models\references\ProfileEducation;
use App\Models\references\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::with('profile')->orderBy('title')->get();
        $profiles = ProfileEducation::pluck('short_title', 'id')->all();
        return view('references.subjects.index', compact('subjects', 'profiles'));
    }

    public function indexAjax() {
        $subjects = Subject::with('profile')->orderBy('title')->get();
        return view('references.subjects.index_ajax', compact('subjects'));
    }

    public function sort(Request $request) {
        $type = $request->get('type');
        $status = $request->get('status');
        switch ($type) {
            case 'title':
                if ($status == 0) {
                    $subjects = Subject::with('profile')->orderByDesc('title')->paginate();
                } else {
                    $subjects = Subject::with('profile')->orderBy('title')->paginate();
                }
                break;
            case 'short_title':
                if ($status == 0) {
                    $subjects = Subject::with('profile')->orderByDesc('short_title')->paginate();
                } else {
                    $subjects = Subject::with('profile')->orderBy('short_title')->paginate();
                }
                break;
            case 'profile':
                if ($status == 0) {
                    $subjects = Subject::with('profile')->orderByDesc('profile_id')->paginate();
                } else {
                    $subjects = Subject::with('profile')->orderBy('profile_id')->paginate();
                }
                break;
        }

        return view('references.subjects.index_ajax', compact('subjects'));
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
            'profile_id' => 'nullable|integer',
            'hard1_4' => 'nullable|integer', 'hard5' => 'nullable|integer', 'hard6' => 'nullable|integer',
            'hard7' => 'nullable|integer', 'hard8' => 'nullable|integer', 'hard9' => 'nullable|integer',
            'hard10_11' => 'nullable|integer'
        ]);
        $title = $request->input('title');
        $short_title = $request->input('short_title');
        $profile_id = $request->input('profile');
        $hard1_4 = $request->input('hard1_4');
        $hard5 = $request->input('hard5');
        $hard6 = $request->input('hard6');
        $hard7 = $request->input('hard7');
        $hard8 = $request->input('hard8');
        $hard9 = $request->input('hard9');
        $hard10_11 = $request->input('hard10_11');

        $data = ['title' => $title, 'short_title' => $short_title, 'profile_id' => $profile_id,
            'hard1_4' => $hard1_4, 'hard5' => $hard5, 'hard6' => $hard6, 'hard7' => $hard7, 'hard8' => $hard8,
            'hard9' => $hard9, 'hard10_11' => $hard10_11];
        try {
            Subject::create($data);
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
        $subject = Subject::find($id);
        $profiles = ProfileEducation::pluck('short_title', 'id')->all();
        return view('references.subjects.edit', compact('subject', 'profiles'));
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
            'profile_id' => 'nullable|integer',
            'hard1_4' => 'nullable|integer', 'hard5' => 'nullable|integer', 'hard6' => 'nullable|integer',
            'hard7' => 'nullable|integer', 'hard8' => 'nullable|integer', 'hard9' => 'nullable|integer',
            'hard10_11' => 'nullable|integer'
        ]);
        $title = $request->input('title');
        $short_title = $request->input('short_title');
        $profile_id = $request->input('profile');
        $hard1_4 = $request->input('hard1_4');
        $hard5 = $request->input('hard5');
        $hard6 = $request->input('hard6');
        $hard7 = $request->input('hard7');
        $hard8 = $request->input('hard8');
        $hard9 = $request->input('hard9');
        $hard10_11 = $request->input('hard10_11');

        $data = ['title' => $title, 'short_title' => $short_title, 'profile_id' => $profile_id,
            'hard1_4' => $hard1_4, 'hard5' => $hard5, 'hard6' => $hard6, 'hard7' => $hard7, 'hard8' => $hard8,
            'hard9' => $hard9, 'hard10_11' => $hard10_11];
        $subject = Subject::find($id);
        try {
            $subject->update($data, ['touch' => false]);
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
            Subject::find($id)->delete();
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка удаления!']);
        }
        return response()->json(['success'=>'success']);
    }
}
