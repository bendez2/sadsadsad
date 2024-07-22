<?php

namespace Application\Repositories;

use Adapters\Interfaces\MongoDBAdapterInterface;
use Application\DTO\BankDTO;
use Carbon\Carbon;
use Domain\BankRepositoryInterface;
use Domain\Entities\Bank;
use Hyperf\Context\ApplicationContext;
use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use function Symfony\Component\String\b;

class BankRepository implements BankRepositoryInterface
{
    #[Inject]
    private MongoDBAdapterInterface $mongoDBAdapter;

    /**
     * @param BankDTO $bankDTO
     * @return bool
     */
    public function create(BankDTO $bankDTO): bool
    {
        $bank = new Bank(
            bic: $bankDTO->bic,
            name: $bankDTO->name,
            corset: $bankDTO->corset
        );

        $this->mongoDBAdapter->mongodbDatabase->selectCollection('banks')->insertOne($bank->toArray());

        return true;
    }

    /**
     * @param string $bic
     * @return BankDTO|null
     */
    public function getByBic(string $bic): ?BankDTO
    {
        $result = $this->mongoDBAdapter->mongodbDatabase->selectCollection('banks')->findOne(['bic' => $bic]);

        if ($result === null) {
            return null;
        }

        $bank = new BankDTO(
            bic: $result->bic,
            name: $result->name,
            corset: $result->corset
        );

        return $bank;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $collections = $this->mongoDBAdapter->mongodbDatabase->selectCollection('banks');

        $allBanks = $collections->find();

        $banksDTO = [];

        foreach ($allBanks as $bank) {
            $banksDTO[] = new BankDTO(
                bic: $bank->bic,
                name: $bank->name,
                corset: $bank->corset
            );
        }

        return $banksDTO;
    }

    /**
     * @param BankDTO $bankDTO
     * @return bool
     */
    public function update(BankDTO $bankDTO): bool
    {
        $collection = $this->mongoDBAdapter->mongodbDatabase->selectCollection('banks');

        $result = $collection->findOne(['bic' => $bankDTO->bic]);

        if ($result === null) {
            return false;
        }

        $bank = Bank::createToObject($result);

        $bank->setNameShort($bankDTO->nameShort);
        $bank->setNameFull($bankDTO->nameFull);

        $collection->updateOne(['bic' => $bank->getBic()],
            ['$set' => [
                'nameShort' => $bank->getNameShort(),
                'nameFull' => $bank->getNameFull()
            ]]);

        return true;
    }
}