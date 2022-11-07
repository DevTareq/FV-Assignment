<?php

namespace App\Entities;

class ScheduleBreak
{
    protected string $startTime;
    protected string $endTime;

    /**
     * @return string
     */
    public function getStartTime(): string
    {
        return $this->startTime;
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
        return $this->endTime;
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
