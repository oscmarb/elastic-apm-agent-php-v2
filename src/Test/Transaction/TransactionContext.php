<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Transaction;

use Oscmarb\ElasticApm\Test\Common\Message;
use Oscmarb\ElasticApm\Test\Common\Page;
use Oscmarb\ElasticApm\Test\Common\Request;
use Oscmarb\ElasticApm\Test\Common\Response;
use Oscmarb\ElasticApm\Test\Common\Service;
use Oscmarb\ElasticApm\Test\Common\Tags;
use Oscmarb\ElasticApm\Test\Common\User;

class TransactionContext implements \JsonSerializable
{
    public function __construct(
        private ?Message $message,
        private ?Page $page,
        private ?Request $request,
        private ?Response $response,
        private ?Service $service,
        private ?Tags $tags,
        private ?User $user
    ) {
    }

    public function message(): ?Message
    {
        return $this->message;
    }

    public function page(): ?Page
    {
        return $this->page;
    }

    public function request(): ?Request
    {
        return $this->request;
    }

    public function response(): ?Response
    {
        return $this->response;
    }

    public function service(): ?Service
    {
        return $this->service;
    }

    public function tags(): ?Tags
    {
        return $this->tags;
    }

    public function user(): ?User
    {
        return $this->user;
    }

    public function jsonSerialize(): array
    {
        return [
            'message' => $this->message,
            'page' => $this->page,
            'request' => $this->request,
            'response' => $this->response,
            'service' => $this->service,
            'tags' => $this->tags,
            'user' => $this->user,
        ];
    }
}