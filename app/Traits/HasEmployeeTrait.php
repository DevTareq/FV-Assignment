<?php

namespace App\Traits;

use App\Interfaces\EmployeeInterface;

trait HasEmployeeTrait
{
    protected EmployeeInterface $employee;

    /**
     * @return EmployeeInterface
     */
    public function getEmployee(): EmployeeInterface
    {
        return $this->employee;
    }

    /**
     * @param EmployeeInterface $employee
     * @return HasEmployeeTrait|\App\Entities\Appointment|\App\Entities\Schedule
     */
    public function setEmployee(EmployeeInterface $employee): self
    {
        $this->employee = $employee;

        return $this;
    }
}
