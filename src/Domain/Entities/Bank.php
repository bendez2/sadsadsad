<?php

namespace Domain\Entities;

class Bank
{
    private string $bic;
    private string $name;
    private string $corset;

    /**
     * @param string $bic
     * @param string $name
     * @param string $corset
     */
    public function __construct(string $bic, string $name, string $corset)
    {
        $this->bic = $bic;
        $this->name = $name;
        $this->corset = $corset;
    }

    /**
     * @param $data
     * @return Bank
     */
    public static function createToObject($data): Bank
    {
        return new self (
            bic: $data->bic,
            name: $data->name,
            corset: $data->corset
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'bic' => $this->bic,
            'name' => $this->name,
            'corset' => $this->corset,
        ];
    }

    /**
     * @return string
     */
    public function getBic(): string
    {
        return $this->bic;
    }

    /**
     * @param string $bic
     * @return void
     */
    public function setBic(string $bic): void
    {
        $this->bic = $bic;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCorset(): string
    {
        return $this->corset;
    }

    /**
     * @param string $corset
     * @return void
     */
    public function setCorset(string $corset): void
    {
        $this->corset = $corset;
    }


}