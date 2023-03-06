<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{asset('public/assets/admin/img/userMe-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            {{--<li class="nav-item">
                <a href="{{route('home')}}" class="nav-link">
                    <i class="fas fa-fire-alt nav-icon"></i>
                    <p>Задачи мне</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('tasks_from_me')}}" class="nav-link">
                    <i class="fas fa-tasks nav-icon"></i>
                    <p>Задачи от меня</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('reports')}}" class="nav-link">
                    <i class="fas fa-file-contract nav-icon"></i>
                    <p>Отчеты</p>
                </a>
            </li>--}}
            <li class="nav-item">
                <a href="{{route('references')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Справочники</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        Расписание
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview ml-2">
                    <li class="nav-item">
                        <a href="{{route('schedule.drafts')}}" class="nav-link">
                            <i class="far fa-calendar-check nav-icon"></i>
                            <p>Все расписания</p>
                        </a>
                        <a href="{{route('schedule.current')}}" class="nav-link">
                            <i class="far fa-edit nav-icon"></i>
                            <p>Изменить текущее</p>
                        </a>
                        <a href="{{route('schedule.make')}}" class="nav-link">
                            <i class="far fa-calendar-plus nav-icon"></i>
                            <p>Составить новое</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('users')}}" class="nav-link">
                    <i class="fas fa-users nav-icon"></i>
                    <p>Пользователи</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
