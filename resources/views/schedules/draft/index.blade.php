@extends('layouts/layout')

@section('content')
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid d-flex" style="justify-content: space-between">
                <div class="row mb-2">
                    <div class="col-sm d-flex">
                        <a href="{{url()->previous()}}" title="Назад">
                            <i class="fas fa-2x fa-angle-left" style="margin-right: 1em; margin-left: 0.25em;"></i>
                        </a>
                        <h1>Черновики расписаний<span class="text-gray ml-3"></span></h1>
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
                    <div class="card-title d-flex" style="width: 100%; justify-content: space-between">
                        <div class="card-subtitle"><b>@if (count($drafts)) Черновики - {{$countDrafts}} шт. @endif</b></div>
                    </div>
                </div>
                <div class="card-body" style="display: flex; justify-content: space-between">
                    @if (count($drafts))
                        <div class="card-body table-responsive p-0" style="max-height: 450px;">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr class="tr-w-sort" title="Нажмите для сортировки">
                                    <th class="th-w-sort"
                                        data-url="" data-status="0" data-type="updatedAt">
                                        Изменён<i class="fa fa-angle-down ml-2"></i>
                                        <i class="fa fa-angle-up ml-2 hide"></i></th>
                                    <th class="th-w-sort"
                                        data-url="" data-status="0" data-type="createdAt">
                                        Создан<i class="fa fa-angle-down ml-2"></i>
                                        <i class="fa fa-angle-up ml-2 hide"></i></th>
                                    <th class="th-w-sort"
                                        data-url="" data-status="0" data-type="terms">
                                        Четверть<i class="fa fa-angle-down ml-2"></i>
                                        <i class="fa fa-angle-up ml-2 hide"></i></th>
                                    <th class="th-w-sort"
                                        data-url="" data-status="0" data-type="steps">
                                        Этапов выполнено<i class="fa fa-angle-down ml-2"></i>
                                        <i class="fa fa-angle-up ml-2 hide"></i></th>
                                    <th class="th-w-sort"
                                        data-url="" data-status="0" data-type="tools">
                                        Действия</th>
                                </tr>
                                </thead>
                                <tbody id="re-tbody">
                                @foreach($drafts as $draft)
                                    <tr class="showStaff text-wrap" data-value="{{$draft->id}}">
                                        <td>{{ $draft->getHumanUpdatedAt() }}</td>
                                        <td>{{ $draft->getHumanCreatedAt() }}</td>
                                        <td>{{ $draft->term->academicYear->getHumanAcademicYear() }}, №
                                            {{ $draft->term->number }}</td>
                                        <td>
                                            @for($i = 1; $i <= 5; $i++)
                                                @if ($i <= $draft->step_id) <span class="badge badge-success">{{$i}}</span>
                                                @else <span class="badge badge-light">{{$i}}</span>
                                                @endif
                                            @endfor
                                        </td>
                                        <td><a class="btn btn-outline-info btn-sm"
                                               href="{{route($draft->step->link_name, ['id'=>$draft->id])}}">
                                                <i class="fas fa-pencil-alt mr-2"></i>Продолжить</a>
                                            <a class="btn btn-outline-danger btn-sm ml-3" href="#">
                                                <i class="fas fa-trash mr-2"></i>Удалить</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div id="ref-loader" class="m-0a ta-c hide">
                                <img src="{{asset('public/assets/front/img/anim/loader.gif')}}"></div>
                        </div>
                    @else
                        <p>Черновиков расписаний нет.</p>
                    @endif
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
                    <p><b>Черновики расписаний</b></p>
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
