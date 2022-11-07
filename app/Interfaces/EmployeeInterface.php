<?php

namespace App\Interfaces;

interface EmployeeInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;
}
