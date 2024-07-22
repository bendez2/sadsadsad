<?php

namespace Application\Job;

use Adapters\Interfaces\CbrAdapterInterface;
use Adapters\Interfaces\DaDataAdapterInterface;
use Domain\BankRepositoryInterface;
use Domain\OrganizationRepositoryInterface;
use Hyperf\AsyncQueue\Job;
use Hyperf\Context\ApplicationContext;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Redis\Redis;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class GetBankJob extends Job
{
    private BankRepositoryInterface $bankRepository;
    private CbrAdapterInterface $cbrAdapter;
    private string $bic;

    public function __construct(string $bic)
    {
        $this->bic = $bic;
    }

    /**
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \RedisException
     */
    public function handle(): void
    {
        $this->cbrAdapter = ApplicationContext::getContainer()->get(CbrAdapterInterface::class);
        $this->bankRepository = ApplicationContext::getContainer()->get(BankRepositoryInterface::class);
        $redis = ApplicationContext::getContainer()->get(Redis::class);

        $bank = $this->cbrAdapter->getByBic($this->bic);

        $redis->set($this->bic, json_encode($bank));

        $this->bankRepository->create($bank);
    }

}