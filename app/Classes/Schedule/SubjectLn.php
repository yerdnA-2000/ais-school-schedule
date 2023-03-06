<?php

namespace App\Classes\Schedule;

class SubjectLn
{
    private int $id;
    private string $title;
    private string $color;

    public function __construct(int $_id, string $_title)
    {
        $this->id = $_id;
        $this->title = $_title;
        $color = '#f0f0f0';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }
}
