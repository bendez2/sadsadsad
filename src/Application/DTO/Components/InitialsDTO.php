<?php

namespace Application\DTO\Components;

class InitialsDTO
{
    public function __construct
    (
        public readonly string $surname,
        public readonly string $name,
        public readonly string $patronymic
    )
    {
    }
}