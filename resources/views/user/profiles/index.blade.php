@extends('layouts/layout')

@section('content')
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid d-flex" style="justify-content: space-between">
                <div class="row mb-2">
                    <div class="col-sm-6 d-flex">
                        <h1>Пользователи</h1>
                    </div>
                </div>
                <button class="popup-open btn btn-outline-secondary btn-sm" type="button" style="height: max-content">
                    <i class="fa fa-question-circle" style="margin-right: 0.25rem"></i> Справка</button>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content d-flex">
            <!-- Default box -->

            <div class="card-body pb-0">
                <div class="row">
                    @foreach($users as $user)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                @if($user->is_admin == 1) Администратор @else Сотрудник @endif
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>{{$user->name}}</b></h2>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class=""><span class="fa-li"><i class="fas fa-envelope">
                                                    </i></span> {{$user->email}}</li>
                                            <li class=""><span class="fa-li"><i class="fas  fa-phone">
                                                    </i></span> +79627955621</li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="@if ($user->avatar == null)
                                        {{asset('public/assets/front/img/emptyAvatar.jpg')}}
                                        @else {{asset('public/uploads/'.$user->avatar)}} @endif" alt="фото пользователя"
                                             class="img-circle img-lg" style="object-fit: cover">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="#" class="btn btn-sm bg-teal">
                                        <i class="fas fa-comments"></i>
                                    </a>
                                    <a href="{{route('users.show', ['user' => $user->id])}}" class="btn btn-sm btn-info">
                                        <i class="fas fa-user"></i> Открыть профиль
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="popup-fade" style="display: none">
                <div class="popup">
                    <a class="popup-close" href="">Закрыть</a>
                    <p><b>Пользователи</b></p>
                    <p>Отображает список пользователей.</p>
                </div>
            </div>
            <div class="disable-click"></div>
        </section>
        <!-- /.content -->
    </div>

@endsection



