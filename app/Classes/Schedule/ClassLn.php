<?php

namespace App\Classes\Schedule;

class ClassLn
{
    private int $id;
    private string $title;

    public function __construct(int $_id, string $_title)
    {
        $this->id = $_id;
        $this->title = $_title;
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
}
