<?php

namespace Domain\ValueObjects;

class Address
{
    /**
     * @param string $addressFullName
     * @param string $country
     */
    public function __construct(
        public readonly string $addressFullName,
        public readonly string $country
    )
    {
    }

    /**
     * @return array{addressFullName: string, country: string}
     */
    public function toArray(): array
    {
        return [
            'addressFullName' => $this->addressFullName,
            'country'         => $this->country,
        ];
    }

    /**
     * @return string
     */
    public function getAddressFullName(): string
    {
        return $this->addressFullName;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}