<?php

namespace App\Strategies\Input;

use App\Interfaces\InputStrategyInterface;

class JsonFile implements InputStrategyInterface
{
    /**
     * @return array
     */
    public function getData(): array
    {
        return json_decode(file_get_contents("./data/schedules.json"), true) ?? [];
    }
}
