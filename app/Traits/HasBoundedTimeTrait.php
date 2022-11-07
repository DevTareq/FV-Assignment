<?php

namespace App\Traits;

use App\Entities\BoundedDateTime;

trait HasBoundedTimeTrait
{
    /**
     * @return BoundedDateTime
     */
    public function getBoundedDateTime(): BoundedDateTime
    {
        return $this->boundedDateTime;
    }

    /**
     * @param BoundedDateTime $boundedDateTime
     * @return \App\Entities\Appointment|\App\Entities\Schedule|HasBoundedTimeTrait
     */
    public function setBoundedDateTime(BoundedDateTime $boundedDateTime): self
    {
        $this->boundedDateTime = $boundedDateTime;

        return $this;
    }
}
