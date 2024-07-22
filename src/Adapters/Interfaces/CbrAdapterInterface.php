<?php

namespace Adapters\Interfaces;

use Application\DTO\BankDTO;

interface CbrAdapterInterface
{
    public function getByBic(string $bic): BankDTO;
    public function getAll(): array;
}