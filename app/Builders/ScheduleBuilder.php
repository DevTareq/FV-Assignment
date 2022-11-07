<?php

namespace App\Builders;

use App\Entities\BoundedDateTime;
use App\Entities\Doctor;
use App\Entities\Schedule;
use App\Interfaces\EmployeeInterface;

class ScheduleBuilder
{
    protected int $scheduleId;
    protected EmployeeInterface $employee;
    protected BoundedDateTime $boundedDateTime;
    protected Schedule $schedule;
    protected ?array $rawSchedule = [];

    /**
     * @return array|null
     */
    public function getRawSchedule(): ?array
    {
        return $this->rawSchedule;
    }

    /**
     * @param array|null $rawSchedule
     */
    public function setRawSchedule(?array $rawSchedule): void
    {
        $this->rawSchedule = $rawSchedule;
    }

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
    public function addScheduleId(int $scheduleId): self
    {
        $this->scheduleId = $scheduleId;

        return $this;
    }

    /**
     * @return BoundedDateTime
     */
    public function getBoundedDateTime(): BoundedDateTime
    {
        return $this->boundedDateTime;
    }

    /**
     * @param BoundedDateTime $boundedDateTime
     * @return $this
     */
    public function addBoundedDateTime(BoundedDateTime $boundedDateTime): self
    {
        $this->boundedDateTime = $boundedDateTime;

        return $this;
    }

    /**
     * @return EmployeeInterface
     */
    public function getEmployee(): EmployeeInterface
    {
        return $this->employee;
    }

    /**
     * @param EmployeeInterface $employee
     * @return $this
     */
    public function addEmployee(EmployeeInterface $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * @param array $schedule
     * @return Schedule
     * @throws \Exception
     */
    public function createFromArray(array $schedule): Schedule
    {
        $this->setRawSchedule($schedule);

        $employee = new Doctor();
        $employee
            ->setId($schedule['employeeId'])
            ->setName($schedule['employeeName']);

        $boundedDateTime = new BoundedDateTime();
        $boundedDateTime
            ->setStartDateTime(new \DateTime($schedule['startDate'] . ' ' . $schedule['startTime']))
            ->setEndDateTime(new \DateTime($schedule['endDate'] . ' ' . $schedule['endTime']));

        $this->addScheduleId($schedule['scheduleId'])
            ->addEmployee($employee)
            ->addBoundedDateTime($boundedDateTime);

        return $this->createObject();
    }

    /**
     * @return Schedule
     */
    private function createObject(): Schedule
    {
        $this->schedule = new Schedule();

        $this->schedule
            ->setScheduleId($this->getScheduleId())
            ->setEmployee($this->getEmployee())
            ->setBoundedDateTime($this->getBoundedDateTime());

        return $this->schedule;
    }
}
