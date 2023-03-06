@extends('layouts/layout')

@section('content')
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid d-flex" style="justify-content: space-between">
                <div class="row mb-2">
                    <div class="col-sm-6 d-flex text-nowrap">
                        <a href="{{url()->previous()}}" title="Назад">
                            <i class="fas fa-2x fa-angle-left" style="margin-right: 1em; margin-left: 0.25em;"></i>
                        </a>
                        <h1>@if ($is_my == 1) Мой профиль
                            @else Пользователь @endif</h1>
                    </div>
                </div>
                <button class="popup-open btn btn-outline-secondary btn-sm" type="button" style="height: max-content">
                    <i class="fa fa-question-circle" style="margin-right: 0.25rem"></i> Справка</button>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content d-flex">
            <!-- Default box -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="img-circle img-lg"
                                         src="@if ($user->avatar == null)
                                    {{asset('public/assets/front/img/emptyAvatar.jpg')}}
                                    @else {{asset('public/uploads/'.$user->avatar)}} @endif" alt="фото пользователя"
                                         style="object-fit: cover; float: none">
                                </div>

                                <h3 class="profile-username text-center">{{$user->name}}</h3>

                                <p class="text-muted text-center">
                                    @if($user->isOnline())
                                            <i class="online-status fa fa-circle mr-2"></i>В сети
                                    @else
                                        <i class="online-status c-disabled fa fa-circle mr-2"></i>Не в сети
                                    @endif </p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>День рождения</b> <a class="float-right">{{$user->staff->getBirthday()}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Статус</b> <a class="float-right">{{$user->staff->status}}</a>
                                    </li>
                                </ul>

                                @if ($is_my == 1)
                                    <a href="{{route('users.edit', ['user' => $user->id])}}"
                                       class="btn btn-outline-secondary btn-block"><b>Редактировать профиль</b></a>
                                @else
                                    <a href="#" class="btn btn-info btn-block"><b>Написать сообщение</b></a>@endif
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <strong><i class="fas fa-address-card mr-1"></i> Сотрудник</strong>
                                <p class="text-muted user-staff">
                                    <a class="staff-link popup-open-show" href="#"
                                        data-value="{{$user->staff->id}}"
                                        data-url="{{route('staffs.show-ajax', ['staff' => $user->staff->id])}}">
                                            {{$user->staff->name}}</a></p>
                                <hr>
                                <strong><i class="fas fa-briefcase mr-1"></i> Должность</strong>
                                <p class="text-muted">
                                        {{$user->staff->positions->pluck('title')->join(', ')}}</p>

                                @if($user->staff->cabinet != null)
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Кабинет</strong>
                                <p class="text-muted">{{$user->staff->cabinet->building->title}},
                                    №{{$user->staff->cabinet->title}}</p> @endif

                                <strong><i class="fas fa-phone mr-1"></i> Контакты</strong>
                                <p class="text-muted">
                                    Электронная почта: <span class="ml-1">{{$user->staff->email}}</span>
                                    <span class="ml-5">Мобильный телефон: <span class="ml-1">+7{{$user->staff->phone}}</span>
                                    </span></p>

                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> Примечание</strong>

                                <p class="text-muted">{{$user->notes}}</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>

            <div class="popup-fade" style="display: none">
                <div class="popup">
                    <a class="popup-close" href="">Закрыть</a>
                    <p><b>Пользователь</b></p>
                    <p>Отображает информацию о пользователе.</p>
                </div>
            </div>
            <div class="popup-fade-show" style="display: none">
                <div class="popup-show card" >
                    <a class="popup-close-show" href="">Закрыть</a>
                    <div class="bruuh"></div>
                </div>
            </div>
            <div class="disable-click"></div>
        </section>
        <!-- /.content -->
    </div>
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function($) {
            $('.user-staff').on('click', '.staff-link', function (e) {
                $('.popup-fade-show').fadeIn();
                let attr = this.getAttribute("data-value");
                let url = this.getAttribute('data-url');
                $.ajax({
                    type: 'GET',
                    url: url,
                    beforeSend: function () {
                    },
                    data: attr,
                    success: function (data) {
                        $('.bruuh').prepend(data);
                    },
                    error: function (res) {
                        alert('Ошибка!');
                    }
                }).done(function () {
                });
                return false;
            });

            $('.popup-close-show').click(function() {
                $('.bruuh').empty();
                $(this).parents('.popup-fade-show').fadeOut();
                return false;
            });

            $(document).keydown(function(e) {
                if (e.keyCode === 27) {
                    e.stopPropagation();
                    $('.bruuh').empty();
                    $('.popup-fade-show').fadeOut();
                }
            });

            $('.popup-fade-show').click(function(e) {
                if ($(e.target).closest('.popup-show').length == 0) {
                    $('.bruuh').empty();
                    $(this).fadeOut();
                }
            });
        });
        /*$( function ($) {
            $('.user-staff').on('click', '.staff-link', function (e) {
                e.preventDefault();
                let attr = this.getAttribute("data-value");
                let url = this.getAttribute('data-url');
                $.ajax({
                    type: 'GET',
                    url: url,
                    beforeSend: function () {
                        alert('ddd');
                    },
                    data: attr,
                    success: function (data) {
                        alert('ddd');
                        $('.popup-show').prepend(data);
                    },
                    error: function (res) {
                        alert('die');
                    }
                }).done(function () {
                });
            });
        });*/

    </script>



@endsection
