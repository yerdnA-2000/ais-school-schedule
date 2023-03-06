@extends('layouts/layout')

@section('content')
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Отчеты</h1>
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
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap-overflow-hidden " >
                            <thead>
                            <tr>
                                <th>Наименование отчета</th>
                                <th>Краткое описание</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="even" data-href="{{route('reports.show', 1)}}">
                                <td class="text-info">Отчет об исполнительской дисциплине</td>
                                <td class="text-gray">
                                    Отображает общее количество задач, задач исполненных в срок, а также – с нарушением заданного срока, то есть оценить дисциплину в конкретных цифрах. Здесь же можно задать отбор по периоду.
                                </td>
                                <td><i class="fas fa-2x fa-angle-right"></i></td>
                            </tr>
                            <tr class="even" data-href="{{route('reports.show', 1)}}">
                                <td class="text-info">Отчет об исполнительской дисциплине</td>
                                <td class="text-gray">
                                    Отображает общее количество задач, задач исполненных в срок, а также – с нарушением заданного срока, то есть оценить дисциплину в конкретных цифрах. Здесь же можно задать отбор по периоду.
                                </td>
                                <td><i class="fas fa-2x fa-angle-right"></i></td>
                            </tr>
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

