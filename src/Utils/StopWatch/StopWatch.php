<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Utils\StopWatch;

use Oscmarb\ElasticApm\Utils\StopWatch\Exception\StopWatchAlreadyRunningException;
use Oscmarb\ElasticApm\Utils\StopWatch\Exception\StopWatchAlreadyStoppedException;
use Oscmarb\ElasticApm\Utils\StopWatch\Exception\StopWatchNotStartedException;
use Oscmarb\ElasticApm\Utils\StopWatch\Exception\StopWatchNotStoppedException;
use Oscmarb\ElasticApm\Utils\TimestampGenerator;

class StopWatch
{
    private ?int $startAt = null;
    private ?int $stopAt = null;

    public function start(): void
    {
        if (null !== $this->startAt) {
            throw new StopWatchAlreadyRunningException();
        }

        $this->startAt = TimestampGenerator::now();
    }

    public function stop(): void
    {
        if (null !== $this->stopAt) {
            throw new StopWatchAlreadyStoppedException();
        }

        if (null === $this->startAt) {
            throw new StopWatchNotStartedException();
        }

        $this->stopAt = TimestampGenerator::now();
    }

    public function duration(): float
    {
        if (null === $this->startAt) {
            throw new StopWatchNotStartedException();
        }

        if (null === $this->stopAt) {
            throw new StopWatchNotStoppedException();
        }

        return ($this->stopAt - $this->startAt) / 1000;
    }
}