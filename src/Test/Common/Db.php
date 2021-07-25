<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Db implements \JsonSerializable
{
    public function __construct(
        private ?string $instance,
        private ?string $link,
        private ?int $rowsAffected,
        private ?string $statement,
        private ?string $type,
        private ?string $user
    ) {
    }

    public function instance(): ?string
    {
        return $this->instance;
    }

    public function link(): ?string
    {
        return $this->link;
    }

    public function rowsAffected(): ?int
    {
        return $this->rowsAffected;
    }

    public function statement(): ?string
    {
        return $this->statement;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function user(): ?string
    {
        return $this->user;
    }

    public function jsonSerialize(): array
    {
        return [
            'instance' => $this->instance,
            'link' => $this->link,
            'rows_affected' => $this->rowsAffected,
            'statement' => $this->statement,
            'type' => $this->type,
            'user' => $this->user,
        ];
    }
}