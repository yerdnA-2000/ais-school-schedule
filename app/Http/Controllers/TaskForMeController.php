<?php

namespace App\Http\Controllers;

use App\Models\StoryTask;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskForMeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $currentDate = Carbon::now();
        $tasks = Task::with('author')
            ->where('executor_id', $user->id)
            ->where('status_id', '!=', 5)
            ->paginate(20);
        $countTotal = $tasks->count();
        $countLate = $tasks
            ->where('finish', '<', $currentDate)
            ->count();

        return view('tasks.tasks_for_me.index',
            compact('tasks', 'countTotal', 'countLate', 'currentDate'));
    }

    public function archive() {
        $user = Auth::user();
        $currentUser = $user->id;
        $currentDate = Carbon::now();
        $tasks = Task::with('author')
            ->where('executor_id', $currentUser)
            ->where('status_id', '=', 5)
            ->orderBy('updated_at')
            ->paginate(20);
        $countTotal = $tasks->count();

        return view('tasks.tasks_for_me.archive',
            compact('tasks','countTotal', 'currentDate', 'currentUser'));
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
        $task = Task::with('executor', 'author', 'status', 'stories')->find($id);
        $stories = StoryTask::with('task', 'author')->where('task_id', $id)
            ->orderByDesc('created_at')
            ->paginate();
        return view('tasks.tasks_for_me.show', compact('task', 'stories'));
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
        $status = $request->input('status');

        $data = ['status_id' => $status];

        $task = Task::find($id);
        $dataStory = ['task_id' => $task->id, 'author_id' => $task->author_id, 'where_changed' => 'Статус задачи',
            'last_value' => 'Не исполнена',
            'current_value' => 'Не проверена'];
        $story = StoryTask::create($dataStory);
        $task->update($data);

        return redirect()->route('tasks_for_me.show', $id);
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
