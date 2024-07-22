<?php

namespace Application\DTO;

class BankDTO
{
    public function __construct(
        public readonly string $bic,
        public readonly string $name,
        public ?string $corset = null
    )
    {
    }

    /**
     * @param $data
     * @return self
     */
    public static function createToObject($data): self
    {
        return new self(
            bic: $data->bic,
            name: $data->name,
            corset: $data->corset ?? null
        );
    }
}