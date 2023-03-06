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
                        <h1>Задача мне - {{$task->id}}</h1>
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
                        <p> @if ($task->is_important == 0) Обычная важность @else Выcокая важность @endif
                            <i class="fas fa-exclamation" style = " margin-left: 0.5em;
                            @if ($task->is_important == 0) color: lightgray @else color: indianred @endif "></i>
                        </p>
                        <div>
                            <span style="margin-left: 5em">Статус:</span>
                            <span style="color: #17a2b8;"> {{$task->status->title}} </span>
                        </div>
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
                        <label style="margin-right: 2em">Автор:</label>
                        <a href="#" class="" style="font-size: 14pt; color: dodgerblue">{{$task->author->name}}</a>
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
                <div class="card-footer">
                    @if ($task->status->id == 1)
                    <form method="post" role="form" action="{{route('tasks_for_me.update', ['tasks_for_me' => $task->id])}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" value="2" name="status">
                        <button type="submit" class="btn btn-info" style="font-size: 14pt">Исполнить задачу
                        </button>
                    </form>
                        @elseif ($task->status->id == 2) <span style="color: gray">Вы исполнили задачу. Ожидайте проверки</span>
                        @elseif ($task->status->id == 5) <span style="color: gray">Задача завершена</span>
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
