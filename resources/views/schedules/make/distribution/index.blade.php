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
                        <h1>Составление нового расписания<span class="text-gray ml-3"> ЭТАП 2</span></h1>
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
                    <div class="card-title d-flex mb-3" style="width: 100%; justify-content: space-between">
                        <div class="card-subtitle">Выберите распределение нагрузки для данного расписания.
                            Или создайте новое распределение нагрузки</div>
                    </div>
                    <div class="row">
                        <form id="store-distribution" method="post" role="form">
                            @csrf
                            <input hidden name="termId" value="{{$termId}}">
                            <button id="create-distribution" class="btn btn-info pl-4 pr-4" type="button"
                                    data-url-store="{{route('schedule.distribution.store')}}">Создать
                                <span class="ml-2"><i class="fas fa-plus"></i></span></button>
                        </form>
                    </div>
                </div>
                <div class="card-body" style="display: flex; justify-content: space-between">
                    <form id="step-2-dist" method="post" role="form"
                          enctype="multipart/form-data" style="width: 100%">
                        @csrf
                        <input hidden name="schId" value="{{$schId}}">
                        <div style="display: flex; flex-direction: column">
                            <div class="row mb-4 mt-2">
                                @if (count($distributions))
                                    <div class="card-body table-responsive p-0" style="height: 320px;">
                                        <table class="table table-bordered table-hover text-nowrap">
                                            <thead>
                                            <tr class="tr-w-sort" title="Нажмите для сортировки">
                                                <th class="th-w-sort"
                                                    data-url="" data-status="0" data-type="chose">
                                                    Выбор</th>
                                                <th class="th-w-sort"
                                                    data-url="" data-status="0" data-type="staffs">
                                                    Наименование<i class="fa fa-angle-down ml-2"></i>
                                                    <i class="fa fa-angle-up ml-2 hide"></i></th>
                                                <th class="th-w-sort"
                                                    data-url="" data-status="0" data-type="subjects">
                                                    Изменён<i class="fa fa-angle-down ml-2"></i>
                                                    <i class="fa fa-angle-up ml-2 hide"></i></th>
                                                <th class="th-w-sort"
                                                    data-url="" data-status="0" data-type="classes">
                                                    Создан<i class="fa fa-angle-down ml-2"></i>
                                                    <i class="fa fa-angle-up ml-2 hide"></i></th>
                                            </tr>
                                            </thead>
                                            <tbody id="ref-tbody" data-url-update=
                                            "{{route('schedule.distribution.indexUpdate', ['id'=>$schId])}}">
                                            @include('schedules.make.distribution.data_table')
                                            </tbody>
                                        </table>
                                        <div id="ref-loader" class="m-0a ta-c hide" style="margin: auto auto">
                                            <img src="{{asset('public/assets/front/img/anim/loader.gif')}}"></div>
                                    </div>
                                @else
                                    <p>Распределения нагрузок нет. Чтобы создать новую, нажмите на кнопку "Создать"</p>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-5 mb-3">
                            <div class="btn-group-lg">
                                <button id="undo-step" type="button"
                                        class="btn btn-outline-secondary mr-5 btn-long" disabled="true">
                                    <i class="fas fa-chevron-circle-left" style="margin-right: 1rem"></i>Назад</button>
                                <button id="chose-distribution" type="button" class="btn btn-info btn-long"
                                        data-url-approp="{{route('schedule.distribution.appropriation')}}"
                                        data-url-redirect="{{route('schedule.workloads', ['id'=>$schId])}}" disabled="true"
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

                <div id="dialog-step-1" class="dialog">
                    <p>
                        <span class="ui-icon ui-icon-check" style="float:left; margin:0 7px 50px 0;"></span>
                        Введённые данные успешно сохранены.
                    </p>
                    <p>
                        Нажмите <b>"Продолжить"</b> если вы хотите продолжить создание расписания.
                    </p>
                    <p>
                        Нажмите <b>"Отмена"</b> если вы хотите отменить создание расписания.
                    </p>
                    <p>
                        <em>При продолжении новое расписание добавится в черновики.</em><br>
                        <a class="a-dialog" href="{{route('schedule.drafts')}}" target="_blank">Открыть черновики в новом окне</a>
                    </p>
                </div>
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





