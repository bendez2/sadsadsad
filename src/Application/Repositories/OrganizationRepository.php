<?php

namespace Application\Repositories;

use Adapters\Interfaces\MongoDBAdapterInterface;
use Application\DTO\Components\AddressDTO;
use Application\DTO\Components\FormDTO;
use Application\DTO\Components\InitialsDTO;
use Application\DTO\Components\ManagementDTO;
use Application\DTO\OrganizationDTO;
use Domain\Entities\Organization;
use Domain\OrganizationRepositoryInterface;
use Domain\ValueObjects\Address;
use Domain\ValueObjects\Form;
use Domain\ValueObjects\Initials;
use Domain\ValueObjects\Management;
use Hyperf\Di\Annotation\Inject;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    #[Inject]
    private MongoDBAdapterInterface $mongoDBAdapter;

    public function create(OrganizationDTO $organization): bool
    {
        $management = null;
        $initials = null;

        switch ($organization->type) {
            case 'LEGAL':
                $management = new Management(
                    name: $organization->management->name,
                    post: $organization->management->post
                );
                break;
            default:
                $initials = new Initials(
                    surname: $organization->initials->surname,
                    name: $organization->initials->name,
                    patronymic: $organization->initials->patronymic
                );
        }

        $address = new Address(
            addressFullName: $organization->address->addressFullName,
            country: $organization->address->country
        );

        $form = new Form(
            full: $organization->form->full,
            short: $organization->form->short
        );

        $organization = new Organization(
            fullNameWithOpf: $organization->fullNameWithOpf,
            shortNameWithOpf: $organization->shortNameWithOpf,
            fullName: $organization->fullName,
            inn: $organization->inn,
            okpo: $organization->okpo,
            okato: $organization->okato,
            oktmo: $organization->oktmo,
            okogu: $organization->okogu,
            okfs: $organization->okfs,
            type: $organization->type,
            address: $address,
            form: $form,
            kpp: $organization->kpp,
            orgn: $organization->orgn,
            shortName: $organization->shortName,
            initials: $initials,
            management: $management,
            divisionType: $organization->divisionType
        );

        $this->mongoDBAdapter->mongodbDatabase->selectCollection('information')->insertOne($organization->toArray());

        return true;
    }

    /**
     * @param string $inn
     * @return OrganizationDTO|null
     */
    public function getByInn(string $inn): ?OrganizationDTO
    {
        $result = $this->mongoDBAdapter->mongodbDatabase->selectCollection('information')->findOne(['inn' => $inn]);

        if ($result === null) {
            return null;
        }

        $management = null;
        $initials = null;

        if ($result->type === 'LEGAL') {
            $managementArray = iterator_to_array($result->management);
            $management = new ManagementDTO(
                name: $managementArray['name'],
                post: $managementArray['post']
            );
        } else if ($result->type === 'INDIVIDUAL') {
            $initialsArray = iterator_to_array($result->initials);
            $initials = new InitialsDTO(
                surname: $initialsArray['surname'],
                name: $initialsArray['name'],
                patronymic: $initialsArray['patronymic']
            );
        }

        $address = new AddressDTO(
            addressFullName: $result->address->addressFullName,
            country: $result->address->country,
        );

        $form = new FormDTO(
            full: $result->form->full,
            short: $result->form->short,
        );

        return new OrganizationDTO(
            fullNameWithOpf: $result->fullNameWithOpf,
            shortNameWithOpf: $result->shortNameWithOpf,
            fullName: $result->fullName,
            inn: $result->inn,
            okpo: $result->okpo,
            okato: $result->okato,
            oktmo: $result->oktmo,
            okogu: $result->okogu,
            okfs: $result->okfs,
            type: $result->type,
            address: $address,
            form: $form,
            orgn: $result->orgn,
            kpp: $result->kpp,
            divisionType: $result->divisionType,
            initials: $initials,
            management: $management,
            shortName: $result->shortName
        );
    }
}