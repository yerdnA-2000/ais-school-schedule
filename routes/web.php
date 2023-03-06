<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\References\BuildingController;
use App\Http\Controllers\References\CabinetController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\References\CallController;
use App\Http\Controllers\References\ClassEduController;
use App\Http\Controllers\References\PositionController;
use App\Http\Controllers\References\ProfileEducationController;
use App\Http\Controllers\References\StaffController;
use App\Http\Controllers\References\SubjectController;
use App\Http\Controllers\References\TeacherController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Schedule\DraftScheduleController;
use App\Http\Controllers\Schedule\Make\CalcController;
use App\Http\Controllers\Schedule\Make\RestrictController;
use App\Http\Controllers\Schedule\Make\WorkloadController;
use App\Http\Controllers\Schedule\Make\WorkloadsDistributionController;
use App\Http\Controllers\Schedule\ScheduleCurrentController;
use App\Http\Controllers\Schedule\ScheduleMakeController;
use App\Http\Controllers\TaskForMeController;
use App\Http\Controllers\TaskFromMeController;
use App\Http\Controllers\TaskMeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Admin\MainController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin', /*'namespace' => 'Admin',*/ 'middleware' => 'admin'], function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::resource('/categories', CategoryController::class);
});

Route::group(['middleware' =>  'guest'], function () {
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'emp', 'admin'], function () {
    Route::get('/tasks_for_me/archive', [TaskForMeController::class, 'archive'])->name('tasks_for_me.archive');
    Route::redirect('/', 'tasks_for_me')->name('home');
    Route::resource('/tasks_for_me', TaskForMeController::class);
    Route::get('/tasks_for_me', [TaskForMeController::class, 'index'])->name('tasks_for_me');

    Route::put('/tasks_from_me/{id}/complete', [TaskFromMeController::class, 'complete'])
        ->name('tasks_from_me.complete');
    Route::get('/tasks_from_me/archive', [TaskFromMeController::class, 'archive'])->name('tasks_from_me.archive');
    Route::resource('/tasks_from_me', TaskFromMeController::class);
    Route::get('/tasks_from_me', [TaskFromMeController::class, 'index'])->name('tasks_from_me');

    Route::resource('/reports', ReportController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

    Route::get('/references', [ReferenceController::class, 'listReferences'])->name('references');

    Route::get('/calls/index-ajax', [CallController::class, 'indexAjax'])
        ->name('calls.index-ajax');
    Route::get('/calls/sort/', [CallController::class, 'sort'])
        ->name('calls.sort');
    Route::resource('/calls', CallController::class);
    Route::get('/calls', [CallController::class, 'index'])->name('calls');

    Route::get('/buildings/index-ajax', [BuildingController::class, 'indexAjax'])
        ->name('buildings.index-ajax');
    Route::get('/buildings/sort/', [BuildingController::class, 'sort'])
        ->name('buildings.sort');
    Route::resource('/buildings', BuildingController::class);
    Route::get('/buildings', [BuildingController::class, 'index'])->name('buildings');

    Route::get('/cabinets/index-ajax', [CabinetController::class, 'indexAjax'])
        ->name('cabinets.index-ajax');
    Route::get('/cabinets/sort/', [CabinetController::class, 'sort'])
        ->name('cabinets.sort');
    Route::resource('/cabinets', CabinetController::class);
    Route::get('/cabinets', [CabinetController::class, 'index'])->name('cabinets');

    Route::get('/profiles/index-ajax', [ProfileEducationController::class, 'indexAjax'])
        ->name('profiles.index-ajax');
    Route::get('/profiles/sort/', [ProfileEducationController::class, 'sort'])->name('profiles.sort');
    Route::resource('/profiles', ProfileEducationController::class);
    Route::get('/profiles', [ProfileEducationController::class, 'index'])->name('profiles');

    Route::get('/subjects/index-ajax', [SubjectController::class, 'indexAjax'])->name('subjects.index-ajax');
    Route::get('/subjects/sort/', [SubjectController::class, 'sort'])->name('subjects.sort');
    Route::resource('/subjects', SubjectController::class);
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects');

    Route::get('/positions/index-ajax', [PositionController::class, 'indexAjax'])
        ->name('positions.index-ajax');
    Route::get('/positions/sort/', [PositionController::class, 'sort'])->name('positions.sort');
    Route::resource('/positions', PositionController::class);
    Route::get('/positions', [PositionController::class, 'index'])->name('positions');

    Route::get('/staffs/index-ajax', [StaffController::class, 'indexAjax'])
        ->name('staffs.index-ajax');
    Route::get('/staffs/show/{staff}', [StaffController::class, 'showAjax'])
        ->name('staffs.show-ajax');
    Route::get('/staffs/sort/', [StaffController::class, 'sort'])->name('staffs.sort');
    Route::resource('/staffs', StaffController::class);
    Route::get('/staffs', [StaffController::class, 'index'])->name('staffs');

    Route::get('/teachers/index-ajax', [TeacherController::class, 'indexAjax'])
        ->name('teachers.index-ajax');
    Route::get('/teachers/sort/', [TeacherController::class, 'sort'])->name('teachers.sort');
    Route::resource('/teachers', TeacherController::class);
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers');

    Route::get('/classes/index-ajax', [ClassEduController::class, 'indexAjax'])
        ->name('classes.index-ajax');
    Route::get('/classes/sort/', [ClassEduController::class, 'sort'])->name('classes.sort');
    Route::resource('/classes', ClassEduController::class);
    Route::get('/classes', [ClassEduController::class, 'index'])->name('classes');

    Route::resource('/users', ProfileController::class);
    Route::get('/users', [ProfileController::class, 'index'])->name('users');

    //Раписание
    Route::get('/schedule/make', [ScheduleMakeController::class, 'index'])->name('schedule.make');
    Route::get('/schedule/current', [ScheduleCurrentController::class, 'index'])->name('schedule.current');
    //-Этап 1
    Route::get('/schedule/make/term-dates', [ScheduleMakeController::class, 'getDatesTermAjax'])
        ->name('schedule.make.getTermDates');
    Route::put('/schedule/make/term-dates/update', [ScheduleMakeController::class, 'updateDatesTermAjax'])
        ->name('schedule.make.updateTermDates');
    //--Черновик
    Route::get('/schedule/drafts', [DraftScheduleController::class, 'index'])->name('schedule.drafts');
    Route::put('/schedule/draft/store', [DraftScheduleController::class, 'store'])
        ->name('schedule.drafts.store');
    //-Этап 2
    Route::get('/schedule/make/{id}/distribution', [WorkloadsDistributionController::class, 'index'])
        ->name('schedule.distribution');
    Route::get('/schedule/make/{id}/distribution/index-update', [WorkloadsDistributionController::class, 'indexUpdate'])
        ->name('schedule.distribution.indexUpdate');
    Route::post('/schedule/distribution/store', [WorkloadsDistributionController::class, 'store'])
        ->name('schedule.distribution.store');
    Route::post('schedule/distribution/approp', [WorkloadsDistributionController::class, 'approp'])
        ->name('schedule.distribution.appropriation');
    //-Этап 3
    Route::get('/schedule/make/{id}/workload', [WorkloadController::class, 'index'])
        ->name('schedule.workloads');
    Route::get('/schedule/make/{id}/workload/index-update', [WorkloadController::class, 'indexUpdate'])
        ->name('schedule.workloads.indexUpdate');
    Route::post('/schedule/make/workload/{distId}/store', [WorkloadController::class, 'store'])
        ->name('schedule.workloads.store');
    //-Этап 4
    Route::get('/schedule/make/{id}/restricts', [RestrictController::class, 'index'])
        ->name('schedule.restricts');
    Route::get('/schedule/make/{id}/restricts/index-update', [RestrictController::class, 'indexUpdate'])
        ->name('schedule.restricts.indexUpdate');
    //-Этап 5 тест
    Route::get('/schedule/make/{id}/calculation-and-save', [CalcController::class, 'index'])
        ->name('schedule.calc');
});

Route::group(['middleware' =>  'auth'], function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

