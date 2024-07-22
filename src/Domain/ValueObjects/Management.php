<?php

namespace Domain\ValueObjects;

class Management
{

    /**
     * @param string $name
     * @param string $post
     */
    public function __construct
    (
        public readonly string $name,
        public readonly string $post
    )
    {
    }

    /**
     * @return array{name: string, post: string}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'post' => $this->post,
        ];
    }

    /**
     * @return string
     */
    public function getPost(): string
    {
        return $this->post;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}