<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Metadata;

use Oscmarb\ElasticApm\Test\Common\Service;
use Oscmarb\ElasticApm\Test\Common\User;

class Metadata implements \JsonSerializable
{
    public function __construct(
        private ?Cloud $cloud,
        private ?Labels $labels,
        private ?Process $process,
        private ?Service $service,
        private ?System $system,
        private ?User $user
    ) {
    }
}