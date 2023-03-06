@extends('layouts/layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6" style="display: flex">
                        <a href="{{url()->previous()}}">
                            <i class="fas fa-2x fa-angle-left" style="margin-right: 1em; margin-left: 0.25em;"></i>
                        </a>
                        <h1>Задача от меня - {{$task->id}} (просмотр)</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$task->title}}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div style="display: flex; justify-content: normal">
                            <p> @if ($task->is_important == 0) Обычная важность @else Выcокая важность @endif </p>
                    </div>

                    <div class="form-group">
                        <p class="form-control" id="content">{{$task->content}}</p>
                    </div>

                    <div class="form-group" style="display: flex;">
                        <div class="form-group" style="margin-right: 10em">
                            <label style="display: block">Начать с</label>
                            <p id="start">{{ $task->getTaskDate('start') }}</p>
                        </div>
                        <div class="form-group" style="margin-right: 10em">
                            <label style="display: block">Закончить к</label>
                            <p id="finish">{{ $task->getTaskDate('finish') }}</p>
                        </div>
                        <div class="form-group">
                            <label style="display: block">Крайний срок</label>
                            <p id="deadline">{{ $task->getTaskDate('deadline') }}</p>
                        </div>
                    </div>

                    <div style="display: flex">
                        <label style="margin-right: 2em">Исполнитель:</label>
                        <a href="#" class="" style="font-size: 14pt; color: dodgerblue">{{$task->executor->name}}</a>
                    </div>

                    @if ($task->previous_task_id != null)
                    <div class="form-group" style="display: flex;">
                        <label>Текущая задача</label>
                        <p>начнется</p>
                        <label style="margin-left: 1em">когда</label>
                        <p>завершится</p>
                        <label style="margin-left: 1em;">задача</label>
                        <p>{{$task->previous_task_id}}</p>
                    </div>
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="display: flex">
                    @if ($task->status_id == 5) <span style="color: gray">Задача завершена</span>
                    @elseif ($task->status->id == 1)
                    <form method="post" role="form" action="{{route('tasks_from_me.complete', [$task->id])}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-info" style="font-size: 14pt">Завершить задачу
                        </button>
                    </form>
                    <a href="{{ route('tasks_from_me.edit', ['tasks_from_me' => $task->id]) }}">
                        <button type="button" class="btn btn-warning"
                                style="font-size: 14pt; margin-left: 0.5em">Редактировать</button>
                    </a>
                    @elseif ($task->status->id == 2)
                    <form method="post" role="form" action="{{route('tasks_from_me.complete', [$task->id])}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-info" style="font-size: 14pt">Завершить задачу
                        </button>
                    </form>
                    @endif
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
            @include('tasks/stories')
        </section>
        <!-- /.content -->
    </div>
@endsection
