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
                        <h1>Составление нового расписания<span class="text-gray ml-3"> ЭТАП 1</span></h1>
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
                        <div class="card-subtitle">Выбираем на какую четверть составляем расписание</div>
                    </div>
                </div>
                <div class="card-body" style="display: flex; justify-content: space-between">
                    <form id="step-1" method="post" role="form"
                          enctype="multipart/form-data" style="width: 100%">
                        @csrf
                        <div style="display: flex; flex-direction: column">
                            <div class="row mb-5 mt-2" style="">
                                <div class="col-5 row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="academic-year">Учебный год</label>
                                            <select class="form-control @error('academic_year') is-invalid @enderror"
                                                    id="academic-year"  autocomplete="off"
                                                    data-placeholder="Начало/Конец учебного года" required>
                                                @foreach($academicYears as $k => $v)
                                                    <option value="{{ $k }}">{{ substr_replace($v, "/", 4, 0) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="number-term">Номер четверти</label>
                                            <select class="form-control @error('number-term') is-invalid @enderror"
                                                    id="number-term" autocomplete="off"
                                                    data-placeholder="Номер четверти" required>
                                                <option selected disabled>Выберите четверть</option>
                                                @foreach($numbersTerm as $k => $v)
                                                    <option value="{{ $k }}">{{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="arrow-right" class="col-auto" style="font-size: 5rem; opacity: 0.15;">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                                {{--Обновляемые--}}
                                <div class="col row ml-5">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="start-date-term" style="display: block">Первый учебный день</label>
                                            <input name="startDate" type='text' disabled="true"
                                                   id="start-date-term" placeholder="Выберите дату"
                                                   class="form-control @error('start_date') is-invalid @enderror"
                                                   data-position="bottom center"/>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="finish-date-term" style="display: block">Крайний учебный день</label>
                                            <input name="finishDate" type='text' disabled="true" required
                                                   id="finish-date-term" placeholder="Выберите дату"
                                                   class="form-control @error('finish_date') is-invalid @enderror"
                                                   data-position="bottom center"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-5 mb-3">
                            <div class="btn-group-lg">
                                <button id="undo-step" type="button"
                                        class="btn btn-outline-secondary mr-5 btn-long" disabled="true">
                                    <i class="fas fa-chevron-circle-left" style="margin-right: 1rem"></i>Назад</button>
                                <button id="store-step-1" type="button" class="btn btn-info btn-long"
                                        data-url-store="" data-url="">Дальше
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



