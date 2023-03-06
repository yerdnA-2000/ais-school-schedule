<?php

namespace App\Classes\Schedule;

class Lesson
{
    private TeacherLn $teacher;
    private ClassLn $class;
    private SubjectLn $subject;
    private int $limitHours;
    private array $conflictLessons;
    private int $countConflicts;

    public function __construct(TeacherLn $_teacher, ClassLn $_class, SubjectLn $_subject, $_limitHours)    {
        $this->teacher = $_teacher;
        $this->class = $_class;
        $this->subject = $_subject;
        $this->limitHours = $_limitHours;
        $this->conflictLessons = [];
    }

    public function isAvailableHours(): bool {
        if ($this->limitHours > 0) {
            return true;
        } else return false;
    }

    public function fillConflictLessons(array $lessons) {
        $c = 0;
        foreach ($lessons as $lesson) {
            if ($this->teacher == $lesson->teacher or $this->class == $lesson->class) {
                $this->conflictLessons[] = $lesson;
                $c++;
            }
        }
        $this->countConflicts = $c;
    }


    //Далее Геттеры и Сеттеры

    public function getTeacher(): \App\Classes\Schedule\TeacherLn
    {
        return $this->teacher;
    }

    public function setTeacher(\App\Classes\Schedule\TeacherLn $teacher): void
    {
        $this->teacher = $teacher;
    }

    public function getClass(): ClassLn
    {
        return $this->class;
    }

    public function setClass(ClassLn $class): void
    {
        $this->class = $class;
    }

    public function getSubject(): SubjectLn
    {
        return $this->subject;
    }

    public function setSubject(SubjectLn $subject): void
    {
        $this->subject = $subject;
    }

    public function getLimitHours(): int
    {
        return $this->limitHours;
    }

    public function setLimitHours(int $limitHours): void
    {
        $this->limitHours = $limitHours;
    }

    public function getConflictLessons(): array
    {
        return $this->conflictLessons;
    }

    public function setConflictLessons(array $conflictLessons): void
    {
        $this->conflictLessons = $conflictLessons;
    }

    public function getCountConflicts(): int
    {
        return $this->countConflicts;
    }

    public function setCountConflicts(int $countConflicts): void
    {
        $this->countConflicts = $countConflicts;
    }

    //Старый вариант
    /*private TeacherLn $teacher;
    private ClassLn $class;
    private SubjectLn $subject;
    private int $limitHours;
    private int $countHours;
    private array $conflictLessons;
    private int $countConflicts;

    public function __construct(TeacherLn $_teacher, ClassLn $_class, SubjectLn $_subject, $_limitHours)    {
        $this->teacher = $_teacher;
        $this->class = $_class;
        $this->subject = $_subject;
        $this->limitHours = $_limitHours;
        $this->countHours = $_limitHours;
        $this->conflictLessons = [];
    }

    public function isAvailableHours(): bool {
        if ($this->countHours > 0) {
            return true;
        } else return false;
    }

    public function decreaseHour(): void {
        $this->countHours--;
    }
    public function increaseHour(): void {
        $this->countHours++;
    }

    public function fillConflictLessons(array $lessons) {
        $c = 0;
        foreach ($lessons as $lesson) {
            if ($this->teacher == $lesson->teacher and $this->class == $lesson->class) {
                $this->conflictLessons[] = $lesson;
                $c = $c + 2;
            } elseif ($this->teacher == $lesson->teacher xor $this->class == $lesson->class) {
                $this->conflictLessons[] = $lesson;
                $c++;
            }
        }
        $this->countConflicts = $c;
    }


    //Далее Геттеры и Сеттеры

    public function getTeacher(): \App\Classes\Schedule\TeacherLn
    {
        return $this->teacher;
    }

    public function setTeacher(\App\Classes\Schedule\TeacherLn $teacher): void
    {
        $this->teacher = $teacher;
    }

    public function getClass(): ClassLn
    {
        return $this->class;
    }

    public function setClass(ClassLn $class): void
    {
        $this->class = $class;
    }

    public function getSubject(): SubjectLn
    {
        return $this->subject;
    }

    public function setSubject(SubjectLn $subject): void
    {
        $this->subject = $subject;
    }

    public function getLimitHours(): int
    {
        return $this->limitHours;
    }

    public function setLimitHours(int $limitHours): void
    {
        $this->limitHours = $limitHours;
    }

    public function getCountHours(): int
    {
        return $this->countHours;
    }

    public function setCountHours(int $countHours): void
    {
        $this->countHours = $countHours;
    }

    public function getConflictLessons(): array
    {
        return $this->conflictLessons;
    }

    public function setConflictLessons(array $conflictLessons): void
    {
        $this->conflictLessons = $conflictLessons;
    }

    public function getCountConflicts(): int
    {
        return $this->countConflicts;
    }

    public function setCountConflicts(int $countConflicts): void
    {
        $this->countConflicts = $countConflicts;
    }*/
}
