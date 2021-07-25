<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Metadata;

class Process implements \JsonSerializable
{
    public function __construct(private ?array $argv, private int $pid, private ?int $ppid, private ?string $title)
    {
    }

    public function argv(): ?array
    {
        return $this->argv;
    }

    public function pid(): int
    {
        return $this->pid;
    }

    public function ppid(): ?int
    {
        return $this->ppid;
    }

    public function title(): ?string
    {
        return $this->title;
    }

    public function jsonSerialize(): array
    {
        return [
            'argv' => $this->argv,
            'pid' => $this->pid,
            'ppid' => $this->ppid,
            'title' => $this->title,
        ];
    }
}