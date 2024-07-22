<?php

namespace Domain\Entities;

use Domain\ValueObjects\Address;
use Domain\ValueObjects\Form;
use Domain\ValueObjects\Initials;
use Domain\ValueObjects\Management;

class Organization
{
    private string $fullNameWithOpf;
    private string $shortNameWithOpf;
    private ?string $shortName;
    private string $fullName;
    private string $inn;
    private ?string $kpp;
    private ?string $orgn;
    private string $okpo;
    private string $okato;
    private string $oktmo;
    private string $okogu;
    private string $okfs;
    private ?string $divisionType;
    private string $type;
    private Form $form;
    private ?Initials $initials;
    private ?Management $management;
    private Address $address;


    /**
     * @param string $fullNameWithOpf
     * @param string $shortNameWithOpf
     * @param string $fullName
     * @param string $inn
     * @param string $kpp
     * @param string $orgn
     * @param string $okpo
     * @param string $okato
     * @param string $oktmo
     * @param string $okogu
     * @param string $okfs
     * @param string $type
     * @param Address $address
     * @param Form $form
     * @param string|null $shortName
     * @param Initials|null $initials
     * @param Management|null $management
     * @param string|null $divisionType
     */
    public function __construct(
        string      $fullNameWithOpf,
        string      $shortNameWithOpf,
        string      $fullName,
        string      $inn,
        string      $okpo,
        string      $okato,
        string      $oktmo,
        string      $okogu,
        string      $okfs,
        string      $type,
        Address     $address,
        Form        $form,
        ?string     $kpp = null,
        ?string     $orgn = null,
        ?string     $shortName = null,
        ?Initials   $initials = null,
        ?Management $management = null,
        ?string     $divisionType = null,
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
     * @return array
     */
    public function toArray(): array
    {
        return [
            'fullNameWithOpf' => $this->fullNameWithOpf,
            'shortNameWithOpf' => $this->shortNameWithOpf,
            'shortName' => $this->shortName,
            'fullName' => $this->fullName,
            'inn' => $this->inn,
            'kpp' => $this->kpp,
            'orgn' => $this->orgn,
            'okpo' => $this->okpo,
            'okato' => $this->okato,
            'oktmo' => $this->oktmo,
            'okogu' => $this->okogu,
            'okfs' => $this->okfs,
            'divisionType' => $this->divisionType,
            'type' => $this->type,
            'form' => $this->form,
            'initials' => $this->initials,
            'management' => $this->management,
            'address' => $this->address,
        ];
    }

    /**
     * @return string
     */
    public function getFullNameWithOpf(): string
    {
        return $this->fullNameWithOpf;
    }

    /**
     * @param string $fullNameWithOpf
     * @return void
     */
    public function setFullNameWithOpf(string $fullNameWithOpf): void
    {
        $this->fullNameWithOpf = $fullNameWithOpf;
    }

    /**
     * @return string
     */
    public function getShortNameWithOpf(): string
    {
        return $this->shortNameWithOpf;
    }

    /**
     * @param string $shortNameWithOpf
     * @return void
     */
    public function setShortNameWithOpf(string $shortNameWithOpf): void
    {
        $this->shortNameWithOpf = $shortNameWithOpf;
    }

    /**
     * @return string|null
     */
    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    /**
     * @param string|null $shortName
     * @return void
     */
    public function setShortName(?string $shortName): void
    {
        $this->shortName = $shortName;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     * @return void
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }

    /**
     * @param string $inn
     * @return void
     */
    public function setInn(string $inn): void
    {
        $this->inn = $inn;
    }

    /**
     * @return string
     */
    public function getKpp(): string
    {
        return $this->kpp;
    }

    /**
     * @param string $kpp
     * @return void
     */
    public function setKpp(string $kpp): void
    {
        $this->kpp = $kpp;
    }

    /**
     * @return string
     */
    public function getOrgn(): string
    {
        return $this->orgn;
    }

    /**
     * @param string $orgn
     * @return void
     */
    public function setOrgn(string $orgn): void
    {
        $this->orgn = $orgn;
    }

    /**
     * @return string
     */
    public function getOkpo(): string
    {
        return $this->okpo;
    }

    /**
     * @param string $okpo
     * @return void
     */
    public function setOkpo(string $okpo): void
    {
        $this->okpo = $okpo;
    }

    /**
     * @return string
     */
    public function getOkato(): string
    {
        return $this->okato;
    }

    /**
     * @param string $okato
     * @return void
     */
    public function setOkato(string $okato): void
    {
        $this->okato = $okato;
    }

    /**
     * @return string
     */
    public function getOktmo(): string
    {
        return $this->oktmo;
    }

    /**
     * @param string $oktmo
     * @return void
     */
    public function setOktmo(string $oktmo): void
    {
        $this->oktmo = $oktmo;
    }

    /**
     * @return string
     */
    public function getOkogu(): string
    {
        return $this->okogu;
    }

    /**
     * @param string $okogu
     * @return void
     */
    public function setOkogu(string $okogu): void
    {
        $this->okogu = $okogu;
    }

    /**
     * @return string
     */
    public function getOkfs(): string
    {
        return $this->okfs;
    }

    /**
     * @param string $okfs
     * @return void
     */
    public function setOkfs(string $okfs): void
    {
        $this->okfs = $okfs;
    }

    /**
     * @return string|null
     */
    public function getDivisionType(): ?string
    {
        return $this->divisionType;
    }

    /**
     * @param string|null $divisionType
     * @return void
     */
    public function setDivisionType(?string $divisionType): void
    {
        $this->divisionType = $divisionType;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }

    /**
     * @param Form $form
     * @return void
     */
    public function setForm(Form $form): void
    {
        $this->form = $form;
    }

    /**
     * @return Initials|null
     */
    public function getInitials(): ?Initials
    {
        return $this->initials;
    }

    /**
     * @param Initials|null $initials
     * @return void
     */
    public function setInitials(?Initials $initials): void
    {
        $this->initials = $initials;
    }

    /**
     * @return Management|null
     */
    public function getManagement(): ?Management
    {
        return $this->management;
    }

    /**
     * @param Management|null $management
     * @return void
     */
    public function setManagement(?Management $management): void
    {
        $this->management = $management;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return void
     */
    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }
}