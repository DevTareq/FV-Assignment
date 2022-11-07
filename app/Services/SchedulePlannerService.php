<?php

namespace App\Services;

use App\Builders\ScheduleBuilder;
use App\Entities\Appointment;
use App\Entities\Schedule;
use App\Entities\ScheduleBreak;
use App\Interfaces\InputStrategyInterface;

class SchedulePlannerService
{
    protected Schedule $schedule;

    /**
     * @param InputStrategyInterface $input
     * @return array
     * @throws \Exception
     */
    public function getAppointments(InputStrategyInterface $input): array
    {
        $schedules = $input->getData();

        $appointments = [];
        foreach ($schedules as $schedule) {

            $builder = new ScheduleBuilder();
            $this->schedule = $builder->createFromArray($schedule);

            // Todo: Create a DTO and Pass it
            $this->populateScheduleBreaks($schedule)
                ->populateScheduleAppointments();

            $appointments[] = $this->schedule->getAppointments();
        }

        $appointments = array_merge(...$appointments);

        $this->sortAppointments($appointments);

        return $appointments;
    }

    /**
     * @param $appointments
     * @return void
     */
    private function sortAppointments(&$appointments): void
    {
        usort($appointments, function (Appointment $appointmentA, Appointment $appointmentB) {
            return $appointmentA->getStartTime() > $appointmentB->getStartTime() ? 1 : -1;
        });
    }

    /**
     * @return void
     */
    private function populateScheduleAppointments(): void
    {
        $startTime = strtotime($this->schedule->getBoundedDateTime()->getStartTime());
        $endTime = strtotime($this->schedule->getBoundedDateTime()->getEndTime());

        $slots = range($startTime, $endTime, Schedule::SLOT_TIME_IN_MINUTES * 60);

        foreach ($slots as $key => $time) {
            if (isset($slots[$key + 1])) {


                $appointment = new Appointment();
                $appointment
                    ->setBoundedDateTime($this->schedule->getBoundedDateTime())
                    ->setStartTime(date("H:i:s", $time))
                    ->setEndTime(date("H:i:s", $slots[$key + 1]))
                    ->setEmployee($this->schedule->getEmployee());

                if (!$this->isBreak($appointment)) {
                    $this->schedule->addAppointment($appointment);
                }
            }
        }

    }

    /**
     * @param array $schedule
     * @return $this
     */
    public function populateScheduleBreaks(array $schedule): self
    {
        $breaks = [];
        if (!$this->isEmptyBreak($schedule['startBreak'], $schedule['endBreak'])) {

            // Use of direct access to reduce the loop
            $break = new ScheduleBreak();
            $break
                ->setStartTime($schedule['startBreak'])
                ->setEndTime($schedule['endBreak']);

            $breaks[] = $break;
        }

        $i = 2;
        foreach ($schedule as $inner) {

            if ($i > 4) {
                break;
            }

            if ($this->isEmptyBreak($schedule['startBreak' . $i], $schedule['endBreak' . $i])) {
                $i++;
                continue;
            }

            $break = new ScheduleBreak();
            $break->setStartTime($schedule['startBreak' . $i])
                ->setEndTime($schedule['endBreak' . $i]);

            $this->schedule->addBreak($break);

            $breaks[] = $break;
            $i++;
        }

        $this->schedule->setScheduleBreak($breaks);

        return $this;
    }

    /**
     * @param Appointment $appointment
     * @return bool
     */
    public function isBreak(Appointment $appointment): bool
    {
        foreach ($this->schedule->getScheduleBreak() as $break) {

            if ((strtotime($appointment->getStartTime()) >= strtotime($break->getStartTime())) &&
                (strtotime($appointment->getEndTime()) <= strtotime($break->getEndTime()))) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $startTime
     * @param string $endTime
     * @return bool
     */
    private function isEmptyBreak(string $startTime, string $endTime): bool
    {
        return $startTime == '00:00:00' && $endTime == '00:00:00';
    }
}
