@extends('layouts/layout')

@section('content')
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid d-flex" style="justify-content: space-between">
                <div class="row mb-2">
                    <div class="col-sm-6 d-flex">
                        <a href="{{url()->previous()}}">
                            <i class="fas fa-2x fa-angle-left" style="margin-right: 1em; margin-left: 0.25em;"></i>
                        </a>
                        <h1>Здания<span class="text-gray ml-3">(справочник)</span></h1>
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
                        <div class="mr-5">
                            <button id="add-building" type="button" class="btn btn-info">Добавить здание
                                <i class="fa fa-plus" style="margin-left: 1em"></i> </button>
                        </div>
                        <button id="expand-cart" class="btn btn-outline-secondary hide" title="Развернуть">
                            <i class="fa fa-expand-alt"></i></button>
                        <button id="compress-cart" class="btn btn-outline-secondary" title="Свернуть">
                            <i class="fa fa-compress-alt"></i></button>
                    </div>
                </div>
                <div class="card-body" style="display: flex; justify-content: space-between">
                    @if (count($buildings))
                        <div class="card-body table-responsive p-0" style="max-height: 300px;">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr class="tr-w-sort" title="Нажмите для сортировки">
                                    <th class="th-w-sort"
                                        data-url="{{route('buildings.sort')}}" data-status="0" data-type="title">
                                        Наименование<i class="fa fa-angle-down ml-2"></i>
                                        <i class="fa fa-angle-up ml-2 hide"></i></th>
                                    <th class="th-w-sort"
                                        data-url="{{route('buildings.sort')}}" data-status="0" data-type="title">
                                        Учитывать при составлении расписания<i class="fa fa-angle-down ml-2"></i>
                                        <i class="fa fa-angle-up ml-2 hide"></i></th>
                                </tr>
                                </thead>
                                <tbody id="ref-tbody">
                                @foreach($buildings as $building)
                                    <tr class="showBuilding" data-value="{{$building->id}}">
                                        <td>{{ $building->title }}</td>
                                        <td> @if ($building->is_schedule == 0) Нет @else Да @endif </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div id="ref-loader" class="m-0a ta-c hide">
                                <img src="{{asset('public/assets/front/img/anim/loader.gif')}}"></div>
                        </div>
                    @else
                        <p>Зданий пока нет...</p>
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

            <div class="card" id="action-form" style="margin-left: 0.5rem">
                <div class="action-header card-header d-flex">
                    <div class="card-title d-flex">
                        <h5 class="m-auto">Здание
                            <span id="header-edit" class="text-gray ml-2 hide">(редактирование)</span>
                            <span id="header-create" class="text-gray ml-2 hide">(новая запись)</span>
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div class="success-response hide">
                            <div class="check_mark">
                                <div class="sa-icon sa-success animate">
                                    <span class="sa-line sa-tip animateSuccessTip"></span>
                                    <span class="sa-line sa-long animateSuccessLong"></span>
                                    <div class="sa-placeholder"></div>
                                    <div class="sa-fix"></div>
                                </div>
                            </div>
                            <span id="edit-success" class="text-success hide ">Изменения сохранены</span>
                            <span id="create-success" class="text-success hide">Запись добавлена</span>
                            <span id="delete-success" class="text-success hide">Запись удалена</span>
                        </div>

                        <div id="loader" class="m-a0 ta-c hide">
                            <img src="{{asset('public/assets/front/img/anim/loader.gif')}}"></div>
                        <div id="form-edit-building">
                            {{--buildings.edit--}}
                        </div>
                        <div id="form-create-building" class="hide">
                            @include('references.buildings.create')
                        </div>
                        <div class="prompt text-gray">Для просмотра/редактирования записи в таблице нажмите на неё</div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="popup-fade" style="display: none">
                <div class="popup">
                    <a class="popup-close" href="">Закрыть</a>
                    <p><b>Справочник "Здания"</b></p>
                    <p>Отображает здания, принадлежащие организации. Поля:</p>
                    <ul>
                        <li><b>Наименование</b> - наименование здания;</li>
                        <li><b>Учитывать при составлении расписания</b> - значение "Да", если здание учитывается при
                            составлении расписания, "Нет", если не учитывается.</li>
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


