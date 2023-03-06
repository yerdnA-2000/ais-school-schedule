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
                        <h1>Составление нового расписания<span class="text-gray ml-3"> ЭТАП 3</span></h1>
                    </div>
                </div>
                <button class="popup-open btn btn-outline-secondary btn-sm" type="button" style="height: max-content">
                    <i class="fa fa-question-circle" style="margin-right: 0.25rem"></i> Справка</button>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content d-flex">
            <!-- Default box -->
            <div class="card col-8" id="data-table">
                <div class="card-header">
                    <div class="card-title d-flex" style="width: 100%; justify-content: space-between">
                        <div class="card-subtitle">Заполните недельную учебную нагрузку на учителя по предмету и классу</div>
                    </div>
                </div>
                <div class="card-body" style="display: flex; justify-content: space-between; flex-direction: column">
                    <span class="mb-2"><b>{{$dist->title}} №{{$dist->id}} для {{$dist->term->number}} четверти
                            {{$sch->term->academicYear->getHumanAcademicYear()}}</b></span>
                    <form id="step-3" method="post" role="form"
                          enctype="multipart/form-data" style="width: 100%">
                        @csrf
                        <div style="display: flex; flex-direction: column">
                            <div class="row mb-5 mt-2">
                                @if (count($workloads))
                                    <div class="card-body table-responsive p-0" style="max-height: 300px;">
                                        <table class="table table-bordered table-hover text-nowrap">
                                            <thead>
                                            <tr class="tr-w-sort" title="Нажмите для сортировки">
                                                <th class="th-w-sort"
                                                    data-url="" data-status="0" data-type="staffs">
                                                    Учитель<i class="fa fa-angle-down ml-2"></i>
                                                    <i class="fa fa-angle-up ml-2 hide"></i></th>
                                                <th class="th-w-sort"
                                                    data-url="" data-status="0" data-type="subjects">
                                                    Предмет<i class="fa fa-angle-down ml-2"></i>
                                                    <i class="fa fa-angle-up ml-2 hide"></i></th>
                                                <th class="th-w-sort"
                                                    data-url="" data-status="0" data-type="classes">
                                                    Класс<i class="fa fa-angle-down ml-2"></i>
                                                    <i class="fa fa-angle-up ml-2 hide"></i></th>
                                                <th class="th-w-sort"
                                                    data-url="" data-status="0" data-type="weekHours">
                                                    Часов в неделю<i class="fa fa-angle-down ml-2"></i>
                                                    <i class="fa fa-angle-up ml-2 hide"></i></th>
                                            </tr>
                                            </thead>
                                            <tbody id="ref-tbody" data-url-update=
                                            "{{route('schedule.workloads.indexUpdate', ['id'=>$sch->id])}}">
                                            @include('schedules.make.workload.data_table')
                                            </tbody>
                                        </table>
                                        <div id="ref-loader" class="m-0a ta-c hide">
                                            <img src="{{asset('public/assets/front/img/anim/loader.gif')}}"></div>
                                    </div>
                                @else
                                    <p>Нагрузок нет. Создайте новые в карточке справа</p>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-5 mb-3">
                            <div class="btn-group-lg">
                                <button id="undo-step" type="button"
                                        class="btn btn-outline-secondary mr-5 btn-long">
                                    <i class="fas fa-chevron-circle-left" style="margin-right: 1rem"></i>Назад</button>
                                <button id="on-restricts" type="button" class="btn btn-info btn-long"
                                        data-url-approp=""
                                        data-url-redirect="{{route('schedule.restricts', ['id'=>$sch->id])}}"
                                        title="Для продолжения выберите распределение нагрузки в таблице">Дальше
                                    <i class="fas fa-chevron-circle-right" style="margin-left: 1rem"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                </div>
                <!-- /.card-footer-->

                <div id="dialog-chose-teacher" class="dialog">
                    <div class="form-group" style="width: 100%; max-height: 350px; overflow: auto">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-nowrap">
                                <tbody class="dialog-tbody">
                                @foreach($staffs as $k => $v)
                                    <tr class="chose-tr text-wrap" data-value="{{$k}}">
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="staffId" value="{{$k}}">
                                                <span>{{$v}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p><em>Нажмите на учителя, чтобы выбрать его</em></p>
                </div>
                <div id="dialog-chose-subject" class="dialog">
                    <div class="form-group" style="width: 100%; max-height: 350px; overflow: auto">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-nowrap">
                                <tbody class="dialog-tbody">
                                @foreach($subjects as $k => $v)
                                    <tr class="chose-tr text-wrap" data-value="{{$k}}">
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="subjectId" value="{{$k}}">
                                                <span>{{$v}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p><em>Нажмите на предмет, чтобы выбрать его</em></p>
                </div>
                <div id="dialog-chose-class" class="dialog">
                    <div class="form-group" style="width: 100%; max-height: 350px; overflow: auto">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-nowrap">
                                <tbody class="dialog-tbody">
                                @foreach($classes as $k => $v)
                                    <tr class="chose-tr text-wrap" data-value="{{$k}}">
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="classId" value="{{$k}}">
                                                <span>{{$v}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p><em>Нажмите на класс, чтобы выбрать его</em></p>
                </div>
            </div>
            <!-- /.card -->
            <div class="card col-4" id="">
                <div class="action-header card-header d-flex">
                    <div class="card-title d-flex">
                        <h5 class="m-auto">Нагрузка
                            <span id="header-edit" class="text-gray ml-2 hide">(редактирование)</span>
                            <span id="header-create" class="text-gray ml-2">(новая запись)</span>
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
                        <div id="form-create-workload" class="">
                            @include('schedules.make.workload.create')
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>


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




