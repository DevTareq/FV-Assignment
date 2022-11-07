<?php

namespace App\Interfaces;

interface HasEmployee
{
    /**
     * @return EmployeeInterface
     */
    public function getEmployee(): EmployeeInterface;

    /**
     * @param EmployeeInterface $employee
     * @return $this
     */
    public function setEmployee(EmployeeInterface $employee): self;
}
