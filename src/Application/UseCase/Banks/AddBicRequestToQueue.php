<?php

namespace Application\UseCase\Banks;

use Application\Job\GetBankJob;
use Hyperf\AsyncQueue\Driver\DriverFactory;
use Hyperf\Context\ApplicationContext;

class AddBicRequestToQueue
{
    public function execute(string $bic, int $delay = 0): bool
    {
        $container = ApplicationContext::getContainer();
        $driver = $container->get(DriverFactory::class);

        $job = new GetBankJob($bic);

        return $driver->get('default')->push($job, $delay);
    }
}