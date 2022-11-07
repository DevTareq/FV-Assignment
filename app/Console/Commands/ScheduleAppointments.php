<?php

namespace App\Console\Commands;

use App\Entities\Appointment;
use App\Services\SchedulePlannerService;
use App\Strategies\Input\JsonFile;
use Illuminate\Console\Command;

class ScheduleAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get available appointments';

    /**
     * @return void
     * @throws \Exception
     */
    public function handle(): void
    {
        $schedulePlannerService = new SchedulePlannerService();
        $inputStrategy = new JsonFile();

        $appointments = $schedulePlannerService->getAppointments($inputStrategy) ?? [];

        if (empty($appointments)) {
            echo 'Unable to find appointments!'; // Throw exception instead
        }

        /** @var Appointment $slot */
        foreach ($appointments as $slot) {
            echo $slot->getBoundedDateTime()->getStartDate(). ' ' .
                 $slot->getstartTime() . ' - ' . $slot->getEndTime() . ' ' .
                 $slot->getEmployee()->getName() . PHP_EOL;
        }
    }
}
