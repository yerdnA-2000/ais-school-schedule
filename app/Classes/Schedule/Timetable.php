<?php

namespace App\Classes\Schedule;

class Timetable
{
    private array $timeslots;

    public function __construct() { $this->timeslots = []; }
    public function __constructOverload(array $timeslots) {
        $this->timeslots = $timeslots;
    }

    public function init(int $days, int $numbers) {
        for ($i = 1; $i <= $days; $i++) {
            for ($j = 1; $j <= $numbers; $j++) {
                $this->addTimeslot(new Timeslot($i, $j));
            }
        }
    }

    public function addTimeslot(Timeslot $timeslot) {
        $this->timeslots[] = $timeslot;
    }

    public function getTimeslots(): array
    {
        return $this->timeslots;
    }

    public function setTimeslots(array $_timeslots): void
    {
        $this->timeslots = $_timeslots;
    }

}
