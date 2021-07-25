<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class User implements \JsonSerializable
{
    public function __construct(
        private ?string $domain,
        private ?string $email,
        private ?string $id,
        private ?string $username
    ) {
    }

    public function domain(): ?string
    {
        return $this->domain;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function id(): ?string
    {
        return $this->id;
    }

    public function username(): ?string
    {
        return $this->username;
    }

    public function jsonSerialize(): array
    {
        return [
            'domain' => $this->domain,
            'email' => $this->email,
            'id' => $this->id,
            'username' => $this->username,
        ];
    }
}