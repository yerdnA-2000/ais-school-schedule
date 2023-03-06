@extends('layouts/layout')

@section('content')
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid d-flex" style="justify-content: space-between">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Справочники</h1>
                    </div>
                </div>
                <button class="popup-open btn btn-outline-secondary btn-sm" type="button" style="height: max-content">
                    <i class="fa fa-question-circle" style="margin-right: 0.25rem"></i> Справка</button>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap-overflow-hidden " >
                            <thead>
                            <tr>
                                <th>Наименование справочника</th>
                                <th>Краткое описание</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="even" data-href="{{route('calls')}}">
                                <td class="text-info">Порядок уроков</td>
                                <td class="text-gray">
                                    Отражает порядок, время начала и окончания уроков.</td>
                                <td><i class="fas fa-2x fa-angle-right"></i></td></tr>
                            <tr class="even" data-href="{{route('buildings')}}">
                                <td class="text-info">Здания</td>
                                <td class="text-gray">
                                    Отображает здания, принадлежащие организации.</td>
                                <td><i class="fas fa-2x fa-angle-right"></i></td></tr>
                            <tr class="even" data-href="{{route('cabinets')}}">
                                <td class="text-info">Кабинеты</td>
                                <td class="text-gray">
                                    Отображает кабинеты в зданиях.</td>
                                <td><i class="fas fa-2x fa-angle-right"></i></td></tr>
                            {{--<tr class="even" data-href="{{route('profiles')}}">
                                <td class="text-info">Профили</td>
                                <td class="text-gray">
                                    Отображает список учебных профилей для учителей и кабинетов.</td>
                                <td><i class="fas fa-2x fa-angle-right"></i></td></tr>--}}
                            <tr class="even" data-href="{{route('subjects')}}">
                                <td class="text-info">Предметы</td>
                                <td class="text-gray">
                                    Отображает список учебных предметов с указанием сложности по классам.</td>
                                <td><i class="fas fa-2x fa-angle-right"></i></td></tr>
                            <tr class="even" data-href="{{route('positions')}}">
                                <td class="text-info">Должности</td>
                                <td class="text-gray">
                                    Отображает должности в организации.</td>
                                <td><i class="fas fa-2x fa-angle-right"></i></td></tr>
                            <tr class="even" data-href="{{route('staffs')}}">
                                <td class="text-info">Сотрудники</td>
                                <td class="text-gray">
                                    Отображает сотрудников по должностям в организации.</td>
                                <td><i class="fas fa-2x fa-angle-right"></i></td></tr>
                            <tr class="even" data-href="{{route('teachers')}}">
                                <td class="text-info">Учителя и их предметы</td>
                                <td class="text-gray">
                                    Отображает список учителей и предметов, которые они ведут.</td>
                                <td><i class="fas fa-2x fa-angle-right"></i></td></tr>
                            <tr class="even" data-href="{{route('classes')}}">
                                <td class="text-info">Классы</td>
                                <td class="text-gray">
                                    Отображает список академических классов по учебным годам.</td>
                                <td><i class="fas fa-2x fa-angle-right"></i></td></tr>
                            <tr class="even" data-href="{{route('profiles')}}">
                                <td class="text-info">Ограничения</td>
                                <td class="text-gray">
                                    Отображает ограничения, накладываемые на расписание.</td>
                                <td><i class="fas fa-2x fa-angle-right"></i></td></tr>
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
            <div class="popup-fade" style="display: none">
                <div class="popup">
                    <a class="popup-close" href="">Закрыть</a>
                    <p><b>Справочники</b></p>
                    <p>Отображает список справочников.</p>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection


