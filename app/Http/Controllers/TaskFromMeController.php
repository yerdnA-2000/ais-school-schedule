<?php

namespace App\Http\Controllers;

use App\Models\StoryTask;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class TaskFromMeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $currentUser = $user->id;
        $currentDate = Carbon::now();
        $tasks = Task::with('executor')
            ->where('author_id', $currentUser)
            ->where('status_id', '!=', 5)
            ->orderBy('deadline')
            ->paginate();
        $countTotal = $tasks->count();
        $countLate = $tasks
            ->where('finish', '<', $currentDate)
            ->count();

        return view('tasks.tasks_from_me.index',
            compact('tasks','countTotal', 'countLate', 'currentDate', 'currentUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $users = User::pluck('name', 'id')->all();
        $tasks = Task::pluck('title', 'id')->all();
        return view('tasks.tasks_from_me.create', compact('users', 'tasks', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'executor_id' => 'required|integer',
            'start' => 'required',
            'finish' => 'required',
            'previous_task_id' => 'nullable',
        ]);

        $parent = null;
        $author_id = $user->id;
        $title = $request->input('title');
        $content = $request->input('content');
        $executor_id = $request->input('executor_id');
        $start = $request->input('start');
        $finish = $request->input('finish');
        $deadline = $request->input('deadline');
        if (isNull($deadline)) $deadline = $finish;

        $data = ['author_id' => $author_id, 'title' => $title, 'content' => $content, 'executor_id' => $executor_id,
            'start' => $start, 'finish' => $finish, 'deadline' => $deadline];
        $task = Task::create($data);

        $dataStory = ['task_id' => $task->id, 'author_id' => $task->author_id, 'where_changed' => 'статус задачи',
            'last_value' => 'Создана', 'current_value' => 'Не исполнена'];
        $story = StoryTask::create($dataStory);

        return redirect()->route('tasks_from_me')->with('success', 'Задача поставлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::with('executor', 'stories')->find($id);
        $stories = StoryTask::with('task', 'author')->where('task_id', $id)
            ->orderByDesc('created_at')
            ->paginate();
        return view('tasks.tasks_from_me.show', compact('task', 'stories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $users = User::pluck('name', 'id')->all();
        $tasks = Task::pluck('title', 'id')->all();
        return view('tasks.tasks_from_me.edit', compact('users', 'tasks', 'task'));
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
            'content' => 'required',
            'executor_id' => 'required|integer',
            'start' => 'required',
            'finish' => 'required',
            'deadline' => 'required',
            'previous_task_id' => 'nullable',
        ]);

        $parent = null;
        $title = $request->input('title');
        $content = $request->input('content');
        $executor_id = $request->input('executor_id');
        $start = $request->input('start');
        $finish = $request->input('finish');
        $deadline = $request->input('deadline');

        $data = ['title' => $title, 'content' => $content, 'executor_id' => $executor_id,
            'start' => $start, 'finish' => $finish, 'deadline' => $deadline];

        $task = Task::find($id);
        //Внесение изменений в историю
        if ($title != $task->title) {
            $dataStory = ['task_id' => $task->id, 'author_id' => $task->author_id, 'where_changed' => 'Название',
                'last_value' => substr($task->title, 0, 10).'...',
                'current_value' => substr($title, 0, 10).'...'];
            $story = StoryTask::create($dataStory);
        }
        if ($content != $task->content) {
            $dataStory = ['task_id' => $task->id, 'author_id' => $task->author_id, 'where_changed' => 'Описание',
                'last_value' => substr($task->content, 0, 10).'...',
                'current_value' => substr($content, 0, 10).'...'];
            $story = StoryTask::create($dataStory);
        }
        if ($start != $task->start) {
            $dataStory = ['task_id' => $task->id, 'author_id' => $task->author_id, 'where_changed' => 'Дата старта',
                'last_value' => substr($task->start, 0, 10),
                'current_value' => substr($start, 0, 10)];
            $story = StoryTask::create($dataStory);
        }
        if ($finish != $task->finish) {
            $dataStory = ['task_id' => $task->id, 'author_id' => $task->author_id, 'where_changed' => 'Дата финиша',
                'last_value' => substr($task->finish, 0, 10),
                'current_value' => substr($finish, 0, 10)];
            $story = StoryTask::create($dataStory);
        }
        if ($deadline != $task->deadline) {
            $dataStory = ['task_id' => $task->id, 'author_id' => $task->author_id, 'where_changed' => 'Крайний срок',
                'last_value' => substr($task->deadline, 0, 10),
                'current_value' => substr($deadline, 0, 10)];
            $story = StoryTask::create($dataStory);
        }

        $task->update($data);

        return redirect()->route('tasks_from_me.show', $id);
    }

    public function complete($id) {
        $data = ['status_id' => 5];
        $task = Task::find($id);
        $dataStory = ['task_id' => $task->id, 'author_id' => $task->author_id, 'where_changed' => 'Статус задачи',
            'last_value' => 'Не проверена',
            'current_value' => 'Завершена'];
        $story = StoryTask::create($dataStory);
        $task->update($data);

        return redirect()->route('tasks_from_me.show', $id);
    }

    public function archive() {
        $user = Auth::user();
        $currentUser = $user->id;
        $currentDate = Carbon::now();
        $tasks = Task::with('executor')
            ->where('author_id', $currentUser)
            ->where('status_id', '=', 5)
            ->orderBy('updated_at')
            ->paginate(20);
        $countTotal = $tasks->count();

        return view('tasks.tasks_from_me.archive',
            compact('tasks','countTotal', 'currentDate', 'currentUser'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('tasks.tasks_from_me.index')->with('success', 'Задача удалена');
    }
}
