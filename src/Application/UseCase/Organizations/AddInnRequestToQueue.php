<?php

namespace Application\UseCase\Organizations;

use Application\Job\InnJob;
use Hyperf\AsyncQueue\Driver\DriverFactory;
use Hyperf\Context\ApplicationContext;

class AddInnRequestToQueue
{

    public function execute(string $inn, int $delay = 0): bool
    {
        $container = ApplicationContext::getContainer();
        $driver = $container->get(DriverFactory::class);

        $job = new InnJob($inn);

        return $driver->get('default')->push($job, $delay);
    }
}