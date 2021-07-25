<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Trace implements \JsonSerializable
{
    public function __construct(
        private ?string $absPath,
        private ?string $className,
        private ?int $colno,
        private ?string $contextLine,
        private ?string $filename,
        private ?string $function,
        private ?bool $libraryFrame,
        private ?int $lineno,
        private ?string $module,
        private array $postContext,
        private array $preContext
    ) {
    }

    public function absPath(): ?string
    {
        return $this->absPath;
    }

    public function className(): ?string
    {
        return $this->className;
    }

    public function colno(): ?int
    {
        return $this->colno;
    }

    public function contextLine(): ?string
    {
        return $this->contextLine;
    }

    public function filename(): ?string
    {
        return $this->filename;
    }

    public function function (): ?string
    {
        return $this->function;
    }

    public function libraryFrame(): ?bool
    {
        return $this->libraryFrame;
    }

    public function lineno(): ?int
    {
        return $this->lineno;
    }

    public function module(): ?string
    {
        return $this->module;
    }

    public function postContext(): array
    {
        return $this->postContext;
    }

    public function preContext(): array
    {
        return $this->preContext;
    }

    public function jsonSerialize(): array
    {
        return [
            'abs_path' => $this->absPath,
            'class_name' => $this->className,
            'colno' => $this->colno,
            'context_line' => $this->contextLine,
            'filename' => $this->filename,
            'function' => $this->function,
            'library_frame' => $this->libraryFrame,
            'lineno' => $this->lineno,
            'module' => $this->module,
            'post_context' => $this->postContext,
            'pre_context' => $this->preContext,
        ];
    }
}