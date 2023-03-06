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
                        <h1>Задача от меня - {{$task->id}} (редкатирование)</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    <form method="post" role="form" action="{{route('tasks_from_me.update', ['tasks_from_me' => $task->id])}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div style="display: flex; justify-content: normal">
                            <div class="form-group" style="width: 100%;">
                                <label for="title">Название</label>
                                <input type="text" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       id="title" value="{{$task->title}}">
                            </div>
                            <div class="custom-control custom-checkbox" style="width: 30%;
                                text-align: right; margin-top: auto; margin-bottom: auto;">
                                <input name="is_important" class="custom-control-input" type="checkbox"
                                       id="customCheckbox1" value="{{$task->is_important}}">
                                <label for="customCheckbox1" class="custom-control-label">Это важная задача</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content">Описание</label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                                      id="content" rows="4">{{$task->content}}</textarea>
                        </div>
                        <div class="form-group" style="display: flex;">
                            <div class="form-group" style="margin-right: 4em">
                                <label for="datepicker-start" style="display: block">Начать с</label>
                                <input name="start" type='text'
                                       id="datepicker-start @error('start') is-invalid @enderror"
                                       data-position="right center" value="{{$task->start}}"/>
                            </div>
                            <div class="form-group" style="margin-right: 4em">
                                <label for="datepicker-finish" style="display: block">Закончить к</label>
                                <input name="finish" type='text'
                                       id="datepicker-finish @error('finish') is-invalid @enderror"
                                       data-position="right center" value="{{$task->finish}}"/>
                            </div>
                            <div class="form-group">
                                <label for="datepicker-deadline" style="display: block">Крайний срок</label>
                                <input name="deadline" type='text'
                                       id="datepicker-deadline @error('deadline') is-invalid @enderror"
                                       data-position="right center" value="{{$task->deadline}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="executor_id">Исполнитель</label>
                            <select class="form-control @error('executor_id') is-invalid @enderror"
                                    id="executor_id" name="executor_id" style="width: 30em;">
                                @foreach($users as $key => $value)
                                    <option value="{{ $key }}" @if($key == $task->executor_id) selected @endif
                                    >
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="card-body">
                            <label for="actions" style="display: block">Файлы</label>
                            <div id="actions" class="row">
                                <div class="col-lg-6">
                                    <div class="btn-group w-100">
                                        <span class="btn btn-success col fileinput-button dz-clickable">
                                            <i class="fas fa-plus"></i>
                                            <span>Добавить файл</span>
                                        </span>
                                        <button type="submit" class="btn btn-primary col start">
                                            <i class="fas fa-upload"></i>
                                            <span>Начать загрузку</span>
                                        </button>
                                        <button type="reset" class="btn btn-warning col cancel">
                                            <i class="fas fa-times-circle"></i>
                                            <span>Отменить</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center">
                                    <div class="fileupload-process w-100">
                                        <div id="total-progress" class="progress progress-striped active"
                                             role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"
                                                 data-dz-uploadprogress=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table table-striped files" id="previews">

                            </div>
                        </div>

                        <div class="form-group" style="display: flex;">
                            <label for="current_task_action">Текущая задача</label>
                            <select name="current_task_action" id="current_task_action"
                                    class="form-control select2bs4 select2-hidden-accessible"
                                    style="width: 10em; margin-left: 1em;" data-select2-id="1"
                                    tabindex="-1" aria-hidden="true">
                                <option data-select2-id="1">начнется</option>
                                <option data-select2-id="2">завершится</option>
                            </select>
                            <label for="previous_task_action" style="margin-left: 1em">когда</label>
                            <select name="previous_task_action" id="previous_task_action"
                                    class="form-control select2bs4 select2-hidden-accessible"
                                    style="width: 10em; margin-left: 1em" data-select3-id="2"
                                    tabindex="-1" aria-hidden="true">
                                <option data-select2-id="1">начнется</option>
                                <option data-select2-id="2">завершится</option>
                            </select>
                            <label for="previous_task_id" style="margin-left: 1em;">задача</label>
                            <select class="form-control" id="previous_task_id" name="previous_task_id"
                                    style="width: 20em; margin-left: 1em">
                                @foreach($tasks as $key => $value)
                                    <option value="{{ $key }}" @if($key == $task->previous_task_id) selected @endif >
                                        {{$key}} - {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Поставить задачу</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            {{--<div class="card-footer">
                <button type="submit" class="btn btn-primary">Поставить задачу</button>
            </div>--}}
            <!-- /.card-footer-->
                <!-- /.card -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

