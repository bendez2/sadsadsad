<?php

namespace Application\DTO;

use Application\DTO\Components\AddressDTO;
use Application\DTO\Components\FormDTO;
use Application\DTO\Components\InitialsDTO;
use Application\DTO\Components\ManagementDTO;
use function Sodium\add;


class OrganizationDTO
{
    public string $fullNameWithOpf;
    public string $shortNameWithOpf;
    public ?string $shortName;
    public string $fullName;
    public string $inn;
    public ?string $kpp;
    public ?string $orgn;
    public string $okpo;
    public string $okato;
    public string $oktmo;
    public string $okogu;
    public string $okfs;
    public ?string $divisionType;
    public string $type;
    public FormDTO $form;
    public ?InitialsDTO $initials;
    public ?ManagementDTO $management;
    public AddressDTO $address;


    public function __construct(
        string         $fullNameWithOpf,
        string         $shortNameWithOpf,
        string         $fullName,
        string         $inn,
        string         $okpo,
        string         $okato,
        string         $oktmo,
        string         $okogu,
        string         $okfs,
        string         $type,
        AddressDTO     $address,
        FormDTO        $form,
        ?string        $orgn,
        ?string        $kpp = null,
        ?string        $divisionType = null,
        ?InitialsDTO   $initials = null,
        ?ManagementDTO $management = null,
        ?string        $shortName = null
    )
    {
        $this->fullNameWithOpf = $fullNameWithOpf;
        $this->shortNameWithOpf = $shortNameWithOpf;
        $this->shortName = $shortName;
        $this->fullName = $fullName;
        $this->inn = $inn;
        $this->kpp = $kpp;
        $this->orgn = $orgn;
        $this->okpo = $okpo;
        $this->okato = $okato;
        $this->oktmo = $oktmo;
        $this->okogu = $okogu;
        $this->okfs = $okfs;
        $this->divisionType = $divisionType;
        $this->type = $type;
        $this->form = $form;
        $this->initials = $initials;
        $this->management = $management;
        $this->address = $address;
    }

    /**
     * @param $data
     * @return self
     */
    public static function createToObject($data): self
    {
        $address = new AddressDTO(
            addressFullName: $data->address->addressFullName,
            country: $data->address->country,
        );

        $form = new FormDTO(
            full: $data->form->full,
            short: $data->form->short
        );

        $management = null;
        $initials = null;

        switch ($data->type) {
            case 'LEGAL':
                $management = new ManagementDTO(
                    name: $data->management->name,
                    post: $data->management->post
                );
                break;
            default:
                $initials = new InitialsDTO(
                    surname: $data->initials->surname,
                    name: $data->initials->name,
                    patronymic: $data->initials->patronymic
                );
        }

        return new self(
            fullNameWithOpf: $data->fullNameWithOpf,
            shortNameWithOpf: $data->shortNameWithOpf,
            fullName: $data->fullName,
            inn: $data->inn,
            okpo: $data->okpo,
            okato: $data->okato,
            oktmo: $data->oktmo,
            okogu: $data->okogu,
            okfs: $data->okfs,
            type: $data->type,
            address: $address,
            form: $form,
            orgn: $data->orgn,
            kpp: $data->kpp,
            divisionType: $data->divisionType,
            initials: $initials,
            management: $management,
            shortName: $data->shortName
        );
    }

}
