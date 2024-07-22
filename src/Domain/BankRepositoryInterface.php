<?php

namespace Domain;

use Application\DTO\BankDTO;

interface BankRepositoryInterface
{
    public function create(BankDTO $bankDTO): bool;

    public function getByBic(string $bic): ?BankDTO;

    public function getAll(): array;

    public function update(BankDTO $bankDTO): bool;
}