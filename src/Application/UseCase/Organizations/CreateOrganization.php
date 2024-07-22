<?php

namespace Application\UseCase\Organizations;

use Application\DTO\OrganizationDTO;
use Domain\OrganizationRepositoryInterface;
use Hyperf\Di\Annotation\Inject;

class CreateOrganization
{
    #[Inject]
    private OrganizationRepositoryInterface $organizationRepository;

    /**
     * @param OrganizationDTO $organization
     * @return bool
     */
    public function execute(OrganizationDTO $organization): bool
    {
        return $this->organizationRepository->create($organization);
    }
}