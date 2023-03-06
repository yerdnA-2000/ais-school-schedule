<?php

namespace App\Http\Controllers\References;

use App\Http\Controllers\Controller;
use App\Models\Call;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calls = Call::orderBy('number')->paginate();
        return view('references.calls.index', compact('calls'));
    }

    public function indexAjax() {
        $calls = Call::orderBy('number')->paginate();
        return view('references.calls.index_ajax', compact('calls'));
    }

    public function sort(Request $request) {
        $type = $request->get('type');
        $status = $request->get('status');
        switch ($type) {
            case 'number':
                if ($status == 0) {
                    $calls = Call::orderByDesc('number')->paginate();
                } else {
                    $calls = Call::orderBy('number')->paginate();
                }
                break;
            case 'start':
                if ($status == 0) {
                    $calls = Call::orderByDesc('start_time')->paginate();
                } else {
                    $calls = Call::orderBy('start_time')->paginate();
                }
                break;
            case 'end':
                if ($status == 0) {
                    $calls = Call::orderByDesc('end_time')->paginate();
                } else {
                    $calls = Call::orderBy('end_time')->paginate();
                }
                break;
        }
        return view('references.calls.index_ajax', compact('calls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'number' => 'required|integer',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $number = $request->input('number');
        $start_time = Carbon::createFromFormat('H:i', $request->input('start_time'))->format('H:i:s');
        $end_time = Carbon::createFromFormat('H:i', $request->input('end_time'))->format('H:i:s');

        $data = ['number' => $number, 'start_time' => $start_time, 'end_time' => $end_time];
        try {
            Call::create($data);
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка добавления! Возможно, номер урока "'.$number.'" уже существует']);
        }
        return response()->json(['success'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($number)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($number)
    {
        $call = Call::where('number', $number)->first();
        return view('references.calls.edit', compact('call'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $number)
    {
        $request->validate([

            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $start_time = Carbon::createFromFormat('H:i', $request->input('start_time'))->format('H:i:s');
        $end_time = Carbon::createFromFormat('H:i', $request->input('end_time'))->format('H:i:s');

        $call = Call::where('number', $number);
        $call->start_time = $start_time;
        $call->end_time = $end_time;

        $data = ['start_time' => $start_time, 'end_time' => $end_time];
        try {
            $call->update($data, ['touch' => false]);
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
    public function destroy($number)
    {
        try {
            Call::where('number', $number)->delete();
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>'Ошибка удаления!']);
        }
        return response()->json(['success'=>'success']);
    }
}
