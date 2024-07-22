<?php

namespace Application\UseCase\Banks;

use Application\DTO\BankDTO;
use Domain\BankRepositoryInterface;
use Hyperf\Di\Annotation\Inject;

class CreateBank
{
    #[Inject]
    private BankRepositoryInterface $bankRepository;
    public function execute(BankDTO $bank): bool
    {
        return $this->bankRepository->create($bank);
    }
}