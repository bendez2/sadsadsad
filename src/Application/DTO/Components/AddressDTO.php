<?php

namespace Application\DTO\Components;

class AddressDTO
{
    public function __construct
    (
        public readonly string $addressFullName,
        public readonly string $country
    )
    {
    }
}