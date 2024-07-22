<?php

namespace Application\UseCase\Banks;

use Application\DTO\BankDTO;
use Domain\BankRepositoryInterface;
use Hyperf\Context\ApplicationContext;
use Hyperf\Di\Annotation\Inject;
use Redis;

class GetBankByBic
{
    #[Inject]
    private BankRepositoryInterface $bankRepository;

    public function execute(string $bic): BankDTO
    {
        $bank = $this->bankRepository->getByBic($bic);

        return $bank;
//        if($bank !== null) {
//            return $bank;
//        }
//
//        $redis = ApplicationContext::getContainer()->get(Redis::class);
//
//        (new AddBicRequestToQueue())->execute($bic);
//
//        $timeout = 5;
//        $start = 0;
//        $interval = 1;
//
//        while ($start < $timeout) {
//            $data = $redis->get($bic);
//
//            if ($data) {
//                $redis->del($bic);
//                return BankDTO::createToObject(json_decode($data));
//            }
//            sleep($interval);
//            $start += $interval;
//        }
    }
}