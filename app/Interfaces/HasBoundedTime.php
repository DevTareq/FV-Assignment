<?php

namespace App\Interfaces;

use App\Entities\BoundedDateTime;

interface HasBoundedTime
{
    /**
     * @return BoundedDateTime
     */
    public function getBoundedDateTime(): BoundedDateTime;

    /**
     * @param BoundedDateTime $boundedDateTime
     * @return $this
     */
    public function setBoundedDateTime(BoundedDateTime $boundedDateTime): self;
}
