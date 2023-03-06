@extends('layouts/layout')

@section('content')
    <style type="text/css">
        .card-body.p-0 .table tbody>tr>td:first-of-type, .card-body.p-0 .table tbody>tr>th:first-of-type, .card-body.p-0 .table thead>tr>td:first-of-type, .card-body.p-0 .table thead>tr>th:first-of-type {
            padding-left: 0.2rem;
        }
    </style>
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid d-flex" style="justify-content: space-between">
                <div class="row mb-2">
                    <div class="col-sm d-flex">
                        <a href="{{url()->previous()}}" title="Назад">
                            <i class="fas fa-2x fa-angle-left" style="margin-right: 1em; margin-left: 0.25em;"></i>
                        </a>
                        <h1>Составление нового расписания<span class="text-gray ml-3"> ЭТАП 5</span></h1>
                    </div>
                </div>
                <button class="popup-open btn btn-outline-secondary btn-sm" type="button" style="height: max-content">
                    <i class="fa fa-question-circle" style="margin-right: 0.25rem"></i> Справка</button>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content d-flex">
            <!-- Default box -->
            <div class="card" id="data-table">
                <div class="card-header">
                    <div class="card-title d-flex mb-2" style="width: 100%; justify-content: space-between">
                        <div class="card-subtitle">Сохранение или перерасчёт расписания</div>
                        <div style="font-size: 0.9rem;"><em>Форма расписания занятий</em></div>
                    </div>
                    <div class="row">
                        <div class="float-left" style="margin: auto 0">
                            <a href="" class="ml-2">
                                <button id="" class="btn btn-success pl-4 pr-4" type="button">Сохранить
                                    <span class="ml-2"><i class="fas fa-save"></i></span></button>
                            </a>
                            <a href="{{route('schedule.calc', ['id'=>$schMaked->id])}}" class="ml-3">
                                <button id="" class="btn btn-warning pl-4 pr-4" type="button">Перерасчитать
                                    <span class="ml-2"><i class="fas fa-undo"></i></span></button>
                            </a>
                            <button id="color-switch" class="btn btn-default pl-4 pr-4 ml-3" type="button">Выключить цвета
                                <span class="ml-2"><i class="fas fa-table"></i></span></button>
                            <span class="ml-2"><b>Выгрузить в:</b></span>
                            <a id="import-class" href="#" class="ml-3" onclick="PrintElem('#section-by-class')">PDF</a>
                            <a id="import-teacher" href="#" class="ml-3 hide" onclick="PrintElem('#section-by-teacher')">PDF</a>
                            <a id="excel-class" href="#" class="ml-3">Excel</a>
                            <a id="excel-teacher" href="#" class="ml-3 hide">Excel</a>
                            <a id="button-excel" href="#" class="ml-3" onclick="PrintElem('#section-by-teacher')">HTML</a>
                        </div>
                        <div class="d-flex" style="margin: 0 0 0 auto">
                            <div class="">
                                <button id="by-class-presentation" class="btn btn-dark pl-4 pr-4"
                                        type="button">По классам</button>
                            </div>
                            <div class="ml-1">
                                <button id="by-teacher-presentation" class="btn btn-outline-dark pl-4 pr-4"
                                        type="button">По учителям</button>
                            </div>
                            <div class="ml-1 mr-2">
                                <button id="" class="btn btn-outline-dark pl-4 pr-4" type="button">По кабинетам</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="display: flex; justify-content: space-between; flex-direction: column">
                    <div id="section-by-class" class="">@include('schedules.make.calc.table_by_class')</div>
                    <div id="section-by-teacher" class="hide">@include('schedules.make.calc.table_by_teacher')</div>

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
                    <p><b>Составление расписания</b></p>
                    <p></p>
                    <ul>
                        <li><b>Сотрудник</b> - сотрудник, который может вести уроки;</li>
                        <li><b>Предметы</b> - предметы, которые сотрудник может вести.</li>
                    </ul>
                    <p>&#8226; Для сортировки таблицы по определённому столбцу нажмите на этот столбец. "Галочка вниз"
                        - по возрастанию, "Галочка вверх" - по убыванию.</p>
                    <p>&#8226; Для просмотра/редактирования записи в таблице нажмите на неё. Для сохранения введённых изменений
                        нажмите кнопку "Сохранить". Для удаления записи нажмите кнопку "Удалить".</p>
                    <p>&#8226; Для создания новой записи в таблице нажмите на кнопку "Добавить ...". Для сохранения
                        новой записи нажмите кнопку "Сохранить". Для отмены заполнения новой записи нажмите кнопку
                        "Отменить".</p>
                </div>
            </div>
            <div class="disable-click"></div>
        </section>
        <!-- /.content -->
    </div>
@endsection





