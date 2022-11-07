<?php

namespace App\Entities;

use App\Interfaces\HasBoundedTime;
use App\Interfaces\HasEmployee;
use App\Traits\HasBoundedTimeTrait;
use App\Traits\HasEmployeeTrait;

class Appointment implements HasEmployee, HasBoundedTime
{
    use HasBoundedTimeTrait, HasEmployeeTrait;

    protected string $startTime;
    protected string $endTime;

    /**
     * @return string
     */
    public function getStartTime(): string
    {
        return date("H:i", strtotime($this->startTime));
    }

    /**
     * @param string $startTime
     * @return $this
     */
    public function setStartTime(string $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndTime(): string
    {
        return date("H:i", strtotime($this->endTime));
    }

    /**
     * @param string $endTime
     * @return $this
     */
    public function setEndTime(string $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }
}
