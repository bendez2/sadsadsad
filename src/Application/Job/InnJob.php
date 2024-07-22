<?php

namespace Application\Job;

use Adapters\Interfaces\DaDataAdapterInterface;
use Adapters\Interfaces\MongoDBAdapterInterface;
use Application\DTO\Components\AddressDTO;
use Application\DTO\Components\FormDTO;
use Application\DTO\Components\InitialsDTO;
use Application\DTO\Components\ManagementDTO;
use Application\DTO\OrganizationDTO;
use Domain\OrganizationRepositoryInterface;
use Exception;
use Hyperf\AsyncQueue\Job;
use Hyperf\Context\ApplicationContext;
use Hyperf\Redis\Redis;

class InnJob extends Job
{
    private DaDataAdapterInterface $dadataAdapter;
    private OrganizationRepositoryInterface $organizationRepository;

    public string $inn;

    public function __construct(string $inn)
    {
        $this->inn = $inn;
    }

    public function handle(): void
    {
        $this->dadataAdapter = ApplicationContext::getContainer()->get(DaDataAdapterInterface::class);
        $this->organizationRepository = ApplicationContext::getContainer()->get(OrganizationRepositoryInterface::class);
        $redis = ApplicationContext::getContainer()->get(Redis::class);

        $result = $this->dadataAdapter->dadataClient->findById("party", $this->inn, 1);

        $initials = null;
        $management = null;

        switch ($result[0]['data']['type']) {
            case 'LEGAL':
                $management = new ManagementDTO(
                    name: $result[0]['data']['management']['name'],
                    post: $result[0]['data']['management']['post']
                );
                break;
            default:
                $initials = new InitialsDTO(
                    surname: $result[0]['data']['fio']['surname'],
                    name: $result[0]['data']['fio']['name'],
                    patronymic: $result[0]['data']['fio']['patronymic']
                );
        }

        $address = new AddressDTO(
            addressFullName: $result[0]['data']['address']['unrestricted_value'],
            country: $result[0]['data']['address']['data']['country_iso_code'],
        );

        $form = new FormDTO(
            full: $result[0]['data']['opf']['full'],
            short: $result[0]['data']['opf']['short']
        );

        $organization = new OrganizationDTO(
            fullNameWithOpf: $result[0]['data']['name']['full_with_opf'],
            shortNameWithOpf: $result[0]['data']['name']['short_with_opf'],
            fullName: $result[0]['value'],
            inn: $result[0]['data']['inn'],
            okpo: $result[0]['data']['okpo'],
            okato: $result[0]['data']['okato'],
            oktmo: $result[0]['data']['oktmo'],
            okogu: $result[0]['data']['okogu'],
            okfs: $result[0]['data']['okfs'],
            type: $result[0]['data']['type'],
            address: $address,
            form: $form,
            orgn: $result[0]['data']['orgn'] ?? null,
            kpp: $result[0]['data']['kpp'] ?? null,
            divisionType: $result[0]['data']['branch_type'] ?? null,
            initials: $initials,
            management: $management,
            shortName: $result[0]['data']['name']['full'],
        );
        $redis->set($this->inn, json_encode($organization));

        $this->organizationRepository->create($organization);
    }
}