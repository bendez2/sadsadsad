<?php

namespace Domain\ValueObjects;

class Form
{
    /**
     * @param string $full
     * @param string $short
     */
    public function __construct
    (
        public readonly string $full,
        public readonly string $short,
    )
    {
    }

    /**
     * @return array{full: string, short: string}
     */
    public function toArray(): array
    {
        return [
            'full'  => $this->full,
           'short' => $this->short,
        ];
    }
    /**
     * @return string
     */
    public function getFull(): string
    {
        return $this->full;
    }

    /**
     * @return string
     */
    public function getShort(): string
    {
        return $this->short;
    }
}