@extends('layouts/layout')

@section('content')
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6" style="display: flex">
                        <a href="{{url()->previous()}}">
                            <i class="fas fa-2x fa-angle-left" style="margin-right: 1em; margin-left: 0.25em;"></i>
                        </a>
                        <h1>Задачи от меня (архив)</h1>
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
                        <div><span style="margin-right: 1em">Всего завершённых задач:</span>
                            <span class="badge badge-info ">@if ($countTotal)  {{$countTotal}} @else 0 @endif</span>
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
                                    <th>Исполнитель</th>
                                    <th>Начать</th>
                                    <th>Закончить к</th>
                                    <th>Крайний срок</th>
                                    <th><i class="fas fa-exclamation"></i> </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr class="even"
                                        data-href="{{route('tasks_from_me.show', ['tasks_from_me' => $task->id])}}">
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>@if ($task->executor->id == $currentUser) Я
                                            @else {{ $task->executor->name }} @endif </td>
                                        <td>{{ $task->getTaskDate('start') }}</td>
                                        <td>{{ $task->getTaskDate('finish') }}</td>
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
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection

