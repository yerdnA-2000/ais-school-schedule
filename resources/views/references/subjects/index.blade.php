@extends('layouts/layout')

@section('content')
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid d-flex" style="justify-content: space-between">
                <div class="row mb-2">
                    <div class="col-sm-6 d-flex">
                        <a href="{{url()->previous()}}" title="Назад">
                            <i class="fas fa-2x fa-angle-left" style="margin-right: 1em; margin-left: 0.25em;"></i>
                        </a>
                        <h1>Предметы<span class="text-gray ml-3">(справочник)</span></h1>
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
                            <button id="add-subject" type="button" class="btn btn-info">Добавить предмет
                                <i class="fa fa-plus" style="margin-left: 1em"></i></button>
                        </div>
                        <button id="expand-cart" class="btn btn-outline-secondary hide" title="Развернуть">
                            <i class="fa fa-expand-alt"></i></button>
                        <button id="compress-cart" class="btn btn-outline-secondary" title="Свернуть">
                            <i class="fa fa-compress-alt"></i></button>
                    </div>
                </div>
                <div class="card-body" style="display: flex; justify-content: space-between">
                    @if (count($subjects))
                        <div class="card-body table-responsive p-0" style="max-height: 350px;">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr class="tr-w-sort" title="Нажмите для сортировки">
                                    <th rowspan="2" class="th-w-sort"
                                        data-url="{{route('subjects.sort')}}" data-status="0" data-type="title">
                                        Наименование<i class="fa fa-angle-down ml-2"></i>
                                        <i class="fa fa-angle-up ml-2 hide"></i></th>
                                    <th rowspan="2" class="th-w-sort"
                                        data-url="{{route('subjects.sort')}}" data-status="0" data-type="short_title">
                                        Кратк. наим.<i class="fa fa-angle-down ml-2"></i>
                                        <i class="fa fa-angle-up ml-2 hide"></i></th>
                                    <th rowspan="2" class="th-w-sort"
                                        data-url="{{route('subjects.sort')}}" data-status="0" data-type="profile">
                                        Профиль<i class="fa fa-angle-down ml-2"></i>
                                        <i class="fa fa-angle-up ml-2 hide"></i></th>
                                    <th class="th-w-sort ta-c" style="pointer-events: none" colspan="7">Сложность по классам</th>
                                </tr>
                                <tr>
                                    <th class="th-w-sort click-n">1-4</th>
                                    <th class="th-w-sort click-n">5</th>
                                    <th class="th-w-sort click-n">6</th>
                                    <th class="th-w-sort click-n">7</th>
                                    <th class="th-w-sort click-n">8</th>
                                    <th class="th-w-sort click-n">9</th>
                                    <th class="th-w-sort click-n">10-11</th>
                                </tr>
                                </thead>
                                <tbody id="ref-tbody">
                                @foreach($subjects as $subject)
                                    <tr class="showSubject text-wrap" data-value="{{$subject->id}}">
                                        <td>{{ $subject->title }}</td>
                                        <td>{{ $subject->short_title }}</td>
                                        <td> @if ($subject->profile->short_title != null)
                                                {{ $subject->profile->short_title }} @else - @endif </td>
                                        <td> @if ($subject->hard1_4 != null) {{ $subject->hard1_4 }} @else - @endif</td>
                                        <td>@if ($subject->hard5 != null) {{ $subject->hard5 }} @else - @endif</td>
                                        <td>@if ($subject->hard6 != null) {{ $subject->hard6 }} @else - @endif</td>
                                        <td>@if ($subject->hard7 != null) {{ $subject->hard7 }} @else - @endif</td>
                                        <td>@if ($subject->hard8 != null) {{ $subject->hard8 }} @else - @endif</td>
                                        <td>@if ($subject->hard9 != null) {{ $subject->hard9 }} @else - @endif</td>
                                        <td>@if ($subject->hard10_11 != null) {{ $subject->hard10_11 }} @else - @endif</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div id="ref-loader" class="m-0a ta-c hide">
                                <img src="{{asset('public/assets/front/img/anim/loader.gif')}}"></div>
                        </div>
                    @else
                        <p>Предметов пока нет...</p>
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
                        <h5 class="m-auto">Предмет
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
                        <div id="form-edit-subject">
                            {{--subjects.edit--}}
                        </div>
                        <div id="form-create-subject" class="hide">
                            @include('references.subjects.create')
                        </div>
                        <div class="prompt text-gray">Для просмотра/редактирования записи в таблице нажмите на неё</div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="popup-fade" style="display: none">
                <div class="popup">
                    <a class="popup-close" href="">Закрыть</a>
                    <p><b>Справочник "Предметы"</b></p>
                    <p>Отображает список учебных предметов с указанием сложности по классам. Поля:</p>
                    <ul>
                        <li><b>Наименование</b> - наименование предмета;</li>
                        <li><b>Кратк. наим.</b> - наименование предмета с сокращёнными словами;</li>
                        <li><b>Профиль</b> - профиль, к которому относится предмет;</li>
                        <li><b>Сложность по классам</b> - сложность предмета по специальной бальной системе по каждому
                            классу. Значение "-" - предмет не ведётся в этом классе. </li>
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



