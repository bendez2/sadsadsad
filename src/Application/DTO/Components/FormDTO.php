<?php

namespace Application\DTO\Components;

class FormDTO
{
    public function __construct(
        public readonly string $full,
        public readonly string $short
    )
    {

    }
}