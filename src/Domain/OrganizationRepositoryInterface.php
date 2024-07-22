<?php

namespace Domain;

use Application\DTO\OrganizationDTO;

interface OrganizationRepositoryInterface
{
    public function create(OrganizationDTO $organization): bool;

    public function getByInn(string $inn): ?OrganizationDTO;
}