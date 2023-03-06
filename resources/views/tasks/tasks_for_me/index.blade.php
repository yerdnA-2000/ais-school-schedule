@extends('layouts/layout')

@section('content')
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Задачи мне</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title" style="display: flex;">
                        <div>
                            <span style="margin-right: 1em">Всего:</span>
                            <span class="badge badge-info ">@if ($countTotal)  {{$countTotal}} @else 0 @endif</span>
                        </div>
                        <div style="margin-left: 5em"><span style="margin-right: 1em">Просроченных:</span>
                            <span class="badge badge-warning ">@if ($countLate)  {{$countLate}} @else 0 @endif</span>
                        </div>
                        <div>
                            <a href="{{route('tasks_for_me.archive')}}">
                                <button type="button" class="btn btn-outline-info" style="margin-left: 5em">Архив задач
                                <i class="fas fa-angle-right" style="margin-left: 1em"></i> </button>
                            </a>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                    @if (count($tasks))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr style="background-color: rgba(74,85,104,0.06)">
                                    <th style="width: 30px">Код</th>
                                    <th>Название</th>
                                    <th>Постановщик</th>
                                    <th>Начать</th>
                                    <th>Закончить к</th>
                                    <th>Крайний срок</th>
                                    <th><i class="fas fa-exclamation"></i> </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr class="even" data-href="{{route('tasks_for_me.show', ['tasks_for_me' => $task->id])}}"
                                    style=" @if ($task->deadline <= $currentDate) color: indianred @endif">
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->author->name }}</td>
                                        <td>{{ $task->getTaskDate('start') }}</td>
                                        <td><span style=" @if ($task->finish <= $currentDate) color: indianred @endif " >
                                                {{ $task->getTaskDate('finish') }}</span></td>
                                        <td>{{ $task->getTaskDate('deadline') }}</td>
                                        <td>
                                            <i class="fas fa-exclamation" style = "
                                            @if ($task->is_important == 0) color: lightgray @else color: indianred @endif "></i>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Задач пока нет...</p>
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection

