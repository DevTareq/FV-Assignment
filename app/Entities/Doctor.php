<?php

namespace App\Entities;

use App\Interfaces\EmployeeInterface;

class Doctor implements EmployeeInterface
{
    protected int $id;
    protected string $name;
    protected Schedule $schedule;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Schedule
     */
    public function getSchedule(): Schedule
    {
        return $this->schedule;
    }

    /**
     * @param Schedule $schedule
     * @return $this
     */
    public function setSchedule(Schedule $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }
}
