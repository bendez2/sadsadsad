<?php

namespace Domain\ValueObjects;

class Initials
{
    /**
     * @param string $surname
     * @param string $name
     * @param string $patronymic
     */
    public function __construct
    (
        public readonly string $surname,
        public readonly string $name,
        public readonly string $patronymic
    )
    {
    }

    /**
     * @return array{surname: string, name: string, patronymic: string}
     */
    public function toArray(): array
    {
        return [
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
        ];
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPatronymic(): string
    {
        return $this->patronymic;
    }


}