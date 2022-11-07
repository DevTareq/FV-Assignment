<?php

namespace App\Entities;

class BoundedDateTime
{
    protected \DateTime $startDateTime;
    protected \DateTime $endDateTime;

    /**
     * @return \DateTime
     */
    public function getStartDateTime(): \DateTime
    {
        return $this->startDateTime;
    }

    /**
     * @param \DateTime $startDate
     * @return $this
     */
    public function setStartDateTime(\DateTime $startDate): self
    {
        $this->startDateTime = $startDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDateTime(): \DateTime
    {
        return $this->endDateTime;
    }

    /**
     * @param \DateTime $endDate
     * @return $this
     */
    public function setEndDateTime(\DateTime $endDate): self
    {
        $this->endDateTime = $endDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->getStartDateTime()->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->getEndDateTime()->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getStartTime(): string
    {
        return $this->getStartDateTime()->format('H:i');
    }

    /**
     * @return string
     */
    public function getEndTime(): string
    {
        return $this->getEndDateTime()->format('H:i');
    }
}
