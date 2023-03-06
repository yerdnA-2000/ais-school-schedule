<?php

namespace App\Http\Controllers\Schedule\Make;

use App\Classes\Schedule\ClassLn;
use App\Classes\Schedule\Lesson;
use App\Classes\Schedule\SubjectLn;
use App\Classes\Schedule\TeacherLn;
use App\Classes\Schedule\Timetable;
use App\Http\Controllers\Controller;
use App\Models\references\Subject;
use App\Models\Schedule\Schedule;
use App\Models\Schedule\Workload;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Cast\Object_;
use App\Facades\ConflictService;

class CalcController extends Controller
{
    public function index($id) {
        $schMaked = Schedule::with('distribution', 'term')->find($id);
        $schMaked->update(['step_id'=>4]);
        $wls = Workload::with('staff', 'subject', 'class')->where('distribution_id', '47')->get();
        ini_set('max_execution_time', 360);
        $mas2 = [];
        /*array_push($mas2, [[[1=>1,2=>2,3=>3],[1=>1,2=>2,3=>3] ]]);*/
        $countWls = $wls->count();
        /*$mas2[] = ['d' => 1, 'n'=>1, 'id' => $wl[rand(0, $countWls)]->id];*/
        /*$wl = $wls->find(rand(1, $countWls));
        $mas2[] = ['d' => 1, 'n' => 1, 'id'=>$wl->id, 't' => $wl->staff_id, 'c' => $wl->class_id,
            's' => $wl->subject_id];
        //удалить этот элемент из исходного массива
        $wl = $wls->find(rand(10, $countWls-1));
        foreach ($mas2 as $i) {
            if ($i['d'] == 1 and $i['n'] == 1 and ($i['c']==$wl->class_id or $i['t']==$wl->staff_id)) {
                break;
            }
        }*/
        /*$n = 1;
        $wl = $wls->find(rand(10, $countWls-1));
        $mas2[] = ['d' => 1, 'n' => 1, 'id'=>$wl->id, 't' => $wl->staff_id, 'c' => $wl->class_id,
            's' => $wl->subject_id];*/
        /*for ($d = 1; $d <= 5; $d++) {
            for ($n = 1; $n <= 5; $n++) {
                $wls = $wls->shuffle();
                foreach ($wls as $wl) {
                    $isExist = 0;
                    foreach ($mas2 as $i) {
                        if ($i['d'] == $d and $i['n'] == $n and ($i['c']==$wl->class_id or $i['t']==$wl->staff_id)) {
                            $isExist = 1;
                        }
                    }
                    if ($isExist == 1) {continue;}
                    else {
                        $mas2[] = ['d' => $d, 'n' => $n, 'id'=>$wl->id, 't' => $wl->staff_id, 'c' => $wl->class_id,
                            's' => $wl->subject_id];
                    }
                }
            }
        }*/
        //Прошлый
        /*while (count($mas2) < 144) {
            unset($mas2);
            $mas2 = [];
            foreach ($wls as $wl) {
                $wl['h'] = $wl->week_hours;
            };
            for ($d = 1; $d <= 5; $d++) {
                for ($n = 1; $n <= 5; $n++) {
                    $wls = $wls->shuffle();
                    foreach ($wls as $wl) {
                        if ($wl->h == 0) {continue;}
                        $isExist = 0;
                        $isRepeat = 0;
                        foreach ($mas2 as $i) {
                            if ($i['d'] == $d and $i['n'] == $n and ($i['l']->class_id == $wl->class_id
                                    or $i['l']->staff_id == $wl->staff_id)) {
                                $isExist = 1;
                            }
                            if ($i['l']->class_id == $wl->class_id) {
                                foreach ($mas2 as $j) {
                                    if ($j['d'] == $d and $j['l']->class_id == $wl->class_id
                                        and $j['l']->subject_id == $wl->subject_id) {
                                        $isRepeat = 1;
                                    }
                                }
                            }
                        }
                        if ($isExist == 1 or $isRepeat == 1) {continue;}
                        else {
                            $mas2[] = ['d' => $d, 'n' => $n, 'l'=>$wl];
                            $wl->h--;
                        }
                    }
                }
            }
        }*/

        /*
            S_i – набор учебных предметов;
            U_k – набор учителей;
            С_j – набор классов;
            A_n – набор действий (уроки) – состоит из S_i, U_k, C_j;
            T_m – набор временных слотов;
            TA_n – набор временных интервалов каждого действия;
            R_p – набор ограничений.
        */

        $days = 5;
        $numbers = 5;
        $staffs = [];
        $classesEdu = [];
        $subjects = [];
        //Инициализация недельной сетки времён - массив(T_m) - и самих времен T_m
        $timetable = new Timetable();
        $timetable->init($days, $numbers, $classesEdu);
        $timeslots = $timetable->getTimeslots();
        //Инициализация массива уроков A_n
        $lessons = [];
        $countCabinet = 1;
        foreach ($wls as $wl) {
            for ($i = 0; $i < $wl->week_hours; $i++) {
                $teacher = null;
                $classEdu = null;
                $subject = null;
                foreach ($lessons as $lesson) {
                    if ($lesson->getTeacher()->getId() == $wl->staff_id) {
                        $teacher = $lesson->getTeacher();
                        goto next_class;
                    }
                }
                $teacher = new TeacherLn($wl->staff_id, $wl->staff->short_name);
                $teacher->setCabinet($countCabinet);
                $countCabinet++;
                $staffs[] = $teacher;
                next_class:
                foreach ($lessons as $lesson) {
                    if ($lesson->getClass()->getId() == $wl->class_id) {
                        $classEdu = $lesson->getClass();
                        goto next_subject;
                    }
                }
                $classEdu = new ClassLn($wl->class_id, $wl->class->title);
                $classesEdu[] = $classEdu;
                next_subject:
                foreach ($lessons as $lesson) {
                    if ($lesson->getSubject()->getId() == $wl->subject_id) {
                        $subject = $lesson->getSubject();
                        goto next_lesson;
                    }
                }
                $subject = new SubjectLn($wl->subject_id, $wl->subject->short_title);
                $subjects[] = $subject;
                next_lesson:
                $lessons[] = new Lesson(
                    $teacher,
                    $classEdu,
                    $subject,
                    $wl->week_hours);
            }
        }
        foreach ($lessons as $lesson) {
            $lesson->getSubject()->setColor('#ffffff');
            switch ($lesson->getSubject()->getId()) {
                case 1: $lesson->getSubject()->setColor('#FFBE73'); break;
                case 2: $lesson->getSubject()->setColor('#70d4ff'); break;
                case 4: $lesson->getSubject()->setColor('#E7C3FF'); break;
                case 7: $lesson->getSubject()->setColor('#fff700'); break;
                case 8: $lesson->getSubject()->setColor('#ffe6a8'); break;
                case 12: $lesson->getSubject()->setColor('#c9ffff'); break;
                case 17: $lesson->getSubject()->setColor('#00ffc4'); break;
                case 18: $lesson->getSubject()->setColor('#ffa8bd'); break;
                case 22: $lesson->getSubject()->setColor('#A8FFA8'); break;
                case 28: $lesson->getSubject()->setColor('#ffbda8'); break;
                case 34: $lesson->getSubject()->setColor('#99b6ff'); break;
            }
        }
        //Инициализация ограничений
        // ...
        //Сортировка A_n
            //Сортировка по убыванию кол-ва конфликтующих уроков и кол-ву часов/нед.
        foreach ($lessons as $lesson) {
            $lesson->fillConflictLessons($lessons);
        }
        usort($lessons, function ($a, $b) {
            return -($a->getCountConflicts() + $a->getLimitHours() - $b->getCountConflicts() - $b->getLimitHours());
        });
        //dd($lessons);
        $c = 0;
        $availableTimeslots = [];
        foreach ($lessons as $lesson) {
            $availableTimeslots = [];
            foreach ($timeslots as $ts) {
                //проверка на конфликты
                foreach ($lesson->getConflictLessons() as $conflictLesson) {
                    if (in_array($conflictLesson, $ts->getLessons())) {
                        goto next;
                    }
                }
                foreach ($timeslots as $dayTimeslot) {
                    if ($dayTimeslot->getDay() == $ts->getDay()) {
                        foreach ($dayTimeslot->getLessons() as $dayLesson) {
                            if ($dayLesson->getSubject()->getId() == $lesson->getSubject()->getId()
                                and $dayLesson->getClass()->getId() == $lesson->getClass()->getId()) {
                                goto next;
                            }
                        }
                    }
                }
                $availableTimeslots[] = $ts;
                $c++;
                next:
                continue;
            }
            //размещение A_i в T_j (lesson в timeslot)
            if (count($availableTimeslots) > 0) {
                $availableTimeslots[array_rand($availableTimeslots, 1)]->appendLesson($lesson);
            }
        }
        /*dd($c, $timeslots, $timetable);*/
        ConflictService::isConflict();

        //Новый
        /*$ls = collect();
        foreach ($wls as $wl) {
            for ($h = 0; $h < $wl->week_hours; $h++) {
                $ls->push($wl);
            }
        }
        unset($mas2);
        $mas2 = [];
        for ($d = 1; $d <= 5; $d++) {
            for ($n = 1; $n <= 5; $n++) {
                $ls = $ls->shuffle();
                foreach ($ls as $l) {
                    $isExist = 0;
                    $isRepeat = 0;
                    foreach ($mas2 as $i) {
                        if ($i['d'] == $d and $i['n'] == $n and ($i['l']->class_id == $l->class_id
                                or $i['l']->staff_id == $l->staff_id)) {
                            $isExist = 1;
                        }
                        if ($i['l']->class_id == $l->class_id) {
                            foreach ($mas2 as $j) {
                                if ($j['d'] == $d and $j['l']->class_id == $l->class_id
                                    and $j['l']->subject_id == $l->subject_id) {
                                    $isRepeat = 1;
                                }
                            }
                        }
                    }
                    if ($isExist == 1 or $isRepeat == 1) {continue;}
                    else {
                        $mas2[] = ['d' => $d, 'n' => $n, 'l'=>$l];
                    }
                }
            }
        }*/
        /*dd($ls);*/

        $dayTimeGrid = $timetable->getTimeslots();
        usort($dayTimeGrid, function ($a, $b) {
            return $a->getDay() - $b->getDay();
        });

        foreach ($dayTimeGrid as $timeslot) {
            $timeslot->sortLessonByClass();
        }

        $sch = $dayTimeGrid;

        return view('schedules.make.calc.index',
            compact('sch', 'staffs', 'classesEdu', 'subjects', 'schMaked'));
    }
}
