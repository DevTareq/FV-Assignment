<?php

namespace App\Entities;

use App\Interfaces\EmployeeInterface;
use App\Interfaces\HasBoundedTime;
use App\Interfaces\HasEmployee;
use App\Traits\HasBoundedTimeTrait;
use App\Traits\HasEmployeeTrait;

class Schedule implements HasEmployee, HasBoundedTime
{
    use HasBoundedTimeTrait, HasEmployeeTrait;

    public const SLOT_TIME_IN_MINUTES = 15;

    protected int $scheduleId;
    protected EmployeeInterface $employee;
    protected BoundedDateTime $boundedDateTime;
    protected ?array $breaks = null;
    protected ?array $appointments = null;

    /**
     * @return int
     */
    public function getScheduleId(): int
    {
        return $this->scheduleId;
    }

    /**
     * @param int $scheduleId
     * @return $this
     */
    public function setScheduleId(int $scheduleId): self
    {
        $this->scheduleId = $scheduleId;

        return $this;
    }

    /**
     * @return ?array
     */
    public function getScheduleBreak(): ?array
    {
        return $this->breaks;
    }

    /**
     * @param array $breaks
     * @return $this
     */
    public function setScheduleBreak(array $breaks): self
    {
        $this->breaks = $breaks;

        return $this;
    }

    /**
     * @param ScheduleBreak $scheduleBreak
     * @return $this
     */
    public function addBreak(ScheduleBreak $scheduleBreak): self
    {
        $this->breaks[] = $scheduleBreak;

        return $this;
    }

    /**
     * @return ?array
     */
    public function getAppointments(): ?array
    {
        return $this->appointments;
    }

    /**
     * @param Appointment $appointment
     * @return $this
     */
    public function addAppointment(Appointment $appointment): self
    {
        $this->appointments[] = $appointment;

        return $this;
    }
}


