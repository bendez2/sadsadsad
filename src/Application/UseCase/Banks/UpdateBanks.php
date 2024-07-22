<?php

namespace Application\UseCase\Banks;

use Adapters\Interfaces\CbrAdapterInterface;
use Domain\BankRepositoryInterface;
use Hyperf\Context\ApplicationContext;
use Hyperf\Crontab\Annotation\Crontab;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

//#[Crontab(rule: "0 0 * * *", name: "UpdateAllBanks", callback: "execute", memo: "updateAllBanks")]
class UpdateBanks
{
    private CbrAdapterInterface $cbrAdapter;
    private BankRepositoryInterface $bankRepository;

    /**
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function execute(): void
    {
        $this->cbrAdapter = ApplicationContext::getContainer()->get(CbrAdapterInterface::class);
        $this->bankRepository = ApplicationContext::getContainer()->get(BankRepositoryInterface::class);

        $banks = $this->bankRepository->getAll();

        foreach ($banks as $bank) {
            $bankCBR = $this->cbrAdapter->getByBic($bank->bic);

            if ($bankCBR->nameFull !== $bank->nameFull || $bankCBR->nameShort !== $bank->nameShort) {
                $this->bankRepository->update($bankCBR);
            }
        }
    }
}