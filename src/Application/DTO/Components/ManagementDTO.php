<?php

namespace Application\DTO\Components;

class ManagementDTO
{
    public function __construct
    (
        public readonly string $name,
        public readonly string $post
    )
    {
    }
}