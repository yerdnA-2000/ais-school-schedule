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
                        <h1>Текущее расписание<span class="text-gray ml-3"> (просмотр)</span></h1>
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
                        <div class="card-subtitle">РАСПИСАНИЕ УРОКОВ на 1 четверть 2022/2024 учебного года</div>
                    </div>
                </div>
                <div class="card-body" style="display: flex; justify-content: space-between">
                    <div class="table-responsive">
                        <table class="iksweb table table-bordered table-hover text-nowrap">
                            <tbody>
                            <tr class="bg-gradient-lightblue">
                                <td style="max-width: 2rem" colspan="3">Классы</td>
                                <td colspan="2">10А</td>
                                <td colspan="2">10Б</td>
                                <td colspan="2">11А</td>
                            </tr>
                            <tr class="bg-tr-middle-grey">
                                <td style="max-width: 2rem" colspan="3">Кл. руководитель</td>
                                <td colspan="2">Липатникова А.С.</td>
                                <td colspan="2">Горелова М.А.</td>
                                <td colspan="2">Попова Т.С.</td>
                            </tr>
                            <tr class="bg-tr-middle-grey">
                                <td style="max-width: 2rem" colspan="3">Закреплённые кабинеты</td>
                                <td colspan="2">23</td>
                                <td colspan="2">18</td>
                                <td colspan="2">5</td>
                            </tr>
                            <tr class="bg-tr-light-grey">
                                <td style="max-width: 2rem">д/н</td>
                                <td style="max-width: 1rem">Урок</td>
                                <td style="max-width: 3rem">Свободные кабинеты</td>
                                <td>Предмет</td>
                                <td>№ каб</td>
                                <td>Предмет</td>
                                <td>№ каб</td>
                                <td>Предмет</td>
                                <td>№ каб</td>
                            </tr>
                            <tr>
                                <td rowspan="8">Пн</td>
                                <td class="ta-c" style="font-style: italic" colspan="8">Дежурный администратор Иванова Д.В.</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>18, 20, 28</td>
                                <td> биол.</td>
                                <td>15</td>
                                <td>рус. яз.</td>
                                <td>24</td>
                                <td>истор.</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>18, 19, 28</td>
                                <td>рус. яз.</td>
                                <td>24</td>
                                <td>биол.</td>
                                <td>15</td>
                                <td>алг.</td>
                                <td>7</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>16, 19</td>
                                <td>физ-ра</td>
                                <td>-</td>
                                <td>физ-ра</td>
                                <td>-</td>
                                <td>биол.</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>16, 19</td>
                                <td>алг.</td>
                                <td>7</td>
                                <td>ин. яз.</td>
                                <td>12, 13</td>
                                <td>физ-ра</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>16, 18</td>
                                <td>ин. яз.</td>
                                <td>12, 13</td>
                                <td>алг.</td>
                                <td>7</td>
                                <td>рус. яз.</td>
                                <td>24</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>16, 18, 23, 28</td>
                                <td>истор.</td>
                                <td>4</td>
                                <td>обж</td>
                                <td>6</td>
                                <td>лит-ра</td>
                                <td>24</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>1, 2, 3, 4, 5, 7, 15, 24, 31</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>обж</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td rowspan="8">Вт</td>
                                <td class="ta-c" style="font-style: italic" colspan="8">Дежурный администратор Сигитова А.В.</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td rowspan="5"></td>
                                <td colspan="8"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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




