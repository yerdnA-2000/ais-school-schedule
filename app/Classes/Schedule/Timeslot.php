<?php

namespace App\Classes\Schedule;

class Timeslot
{
    private int $day;
    private int $number;
    private ?array $lessons;
    private string $weekDay;

    public function __construct(int $_day, int $_number)
    {
        $this->day = $_day;
        $this->number = $_number;
        $this->lessons = [];
        switch ($_day) {
            /*case 1: $this->weekDay = 'понедельник'; break;
            case 2: $this->weekDay = 'вторник'; break;
            case 3: $this->weekDay = 'среда'; break;
            case 4: $this->weekDay = 'четверг'; break;
            case 5: $this->weekDay = 'пятница'; break;*/
            case 1: $this->weekDay = 'пн'; break;
            case 2: $this->weekDay = 'вт'; break;
            case 3: $this->weekDay = 'ср'; break;
            case 4: $this->weekDay = 'чт'; break;
            case 5: $this->weekDay = 'пт'; break;
            case 6: $this->weekDay = 'сб'; break;
            case 7: $this->weekDay = 'вс'; break;
        }
    }

    public function isEmptyLesson(): bool {
        if ($this->lessons == null) {
            return true;
        } else return false;
    }

    public function sortLessonByClass() {
        usort($this->lessons, function ($a, $b) {
            return $a->getClass()->getId() - $b->getClass()->getId();
        });
    }

    public function sortLessonByTeacher() {
        usort($this->lessons, function ($a, $b) {
            return $a->getTeacher()->getId() - $b->getTeacher()->getId();
        });
    }

    public function appendLesson (Lesson $_lesson): void {
        $this->lessons[] = $_lesson;
    }

    public function removeLesson (): void {
        $this->lessons = null;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function getLessons(): array
    {
        return $this->lessons;
    }

    public function setLessons(array $lessons): void
    {
        $this->lessons = $lessons;
    }

    public function getDay(): int
    {
        return $this->day;
    }

    public function setDay(int $day): void
    {
        $this->day = $day;
    }

    /**
     * @return string
     */
    public function getWeekDay(): string
    {
        return $this->weekDay;
    }

    /**
     * @param string $weekDay
     */
    public function setWeekDay(string $weekDay): void
    {
        $this->weekDay = $weekDay;
    }

}
