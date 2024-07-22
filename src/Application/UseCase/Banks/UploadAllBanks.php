<?php

namespace Application\UseCase\Banks;

use Adapters\Interfaces\CbrAdapterInterface;
use Adapters\Interfaces\DaDataAdapterInterface;
use Domain\BankRepositoryInterface;
use Hyperf\Di\Annotation\Inject;

class UploadAllBanks
{
    #[Inject]
    private BankRepositoryInterface $bankRepository;
    #[Inject]
    private DaDataAdapterInterface $daDataAdapter;
    #[Inject]
    private CbrAdapterInterface $cbrAdapter;

    public function execute(): bool
    {
        try {
            $banks = $this->cbrAdapter->getAll();

            foreach ($banks as $bank) {
                $result = $this->daDataAdapter->dadataClient->findById("bank", $bank->bic, 1);

                $bank->corset = $result['0']['data']['correspondent_account'] ?? null;

                $this->bankRepository->create($bank);
            }

            return true;
        }
        catch (\Exception $e) {
var_dump($e->getMessage());
        }
    }
}