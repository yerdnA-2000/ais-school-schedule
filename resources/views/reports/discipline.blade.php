@extends('layouts/layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 nowrap" style="display: flex; white-space: nowrap">
                        <a href="{{url()->previous()}}">
                            <i class="fas fa-2x fa-angle-left" style="margin-right: 1em; margin-left: 0.25em;"></i>
                        </a>
                        <h1>Отчет об исполнительской дисциплине</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead>
                            <tr style="background-color: rgba(74,85,104,0.06)">
                                <th rowspan="2">Исполнитель задач</th>
                                <th rowspan="2">Количество задач
                                    <th colspan="3" style="text-align: center">Выполнено</th>
                                    <th colspan="2" style="text-align: center">Не выполнено</th>
                                </th>
                            </tr>
                            <tr class="bg-gray-light">
                                <th>Всего</th>
                                <th>В срок</th>
                                <th>Не в срок</th>
                                <th>Всего</th>
                                <th>Просроченно</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                            <tr class="even">
                                <td>{{$item->executor->name}}</td>
                                <td>{{$item->countTotal}}</td>
                                <td>{{$item->countExecuted}}</td>
                                <td>{{$item->countExecutedOnTime}}</td>
                                <td>{{$item->countExecutedNotOnTime}}</td>
                                <td>{{$item->countNotExecuted}}</td>
                                <td>{{$item->countNotExecutedNotOnTime}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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
