<?php

namespace Application\UseCase\Organizations;

use Adapters\Interfaces\DaDataAdapterInterface;
use Application\DTO\OrganizationDTO;
use Domain\OrganizationRepositoryInterface;
use Hyperf\Context\ApplicationContext;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Redis\Redis;

class GetOrganizationByInn
{
    #[Inject]
    private OrganizationRepositoryInterface $organizationRepository;



    public function execute(string $inn): OrganizationDTO
    {
        $organization = $this->organizationRepository->findByInn($inn);

        if ($organization !== null) {
            return $organization;
        }
        $redis = ApplicationContext::getContainer()->get(Redis::class);

        (new AddInnRequestToQueue())->execute($inn);

        $timeout = 5;
        $start = 0;
        $interval = 1;

        while ($start < $timeout) {
            $data = $redis->get($inn);

            if ($data) {
                $redis->del($inn);
                return OrganizationDTO::createToObject(json_decode($data));
            }
            sleep($interval);
            $start += $interval;
        }
    }
}