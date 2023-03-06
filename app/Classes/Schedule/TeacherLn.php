<?php

namespace App\Classes\Schedule;

class TeacherLn
{
    private int $id;
    private string $name;
    private string $cabinet;

    public function __construct(int $_id, string $_name)
    {
        $this->id = $_id;
        $this->name = $_name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCabinet(): string
    {
        return $this->cabinet;
    }

    /**
     * @param string $cabinet
     */
    public function setCabinet(string $cabinet): void
    {
        $this->cabinet = $cabinet;
    }
}
