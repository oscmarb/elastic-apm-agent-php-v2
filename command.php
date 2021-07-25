<?php

use Oscmarb\ElasticApm\Configuration\Configuration;
use Oscmarb\ElasticApm\ElasticApmTracer;
use Oscmarb\ElasticApm\Pool\Memory\MemoryEventPool;
use Oscmarb\ElasticApm\Reporter\Curl\CurlReporter;

require 'vendor/autoload.php';


$configuration = new Configuration('app bro');
$tracer = new ElasticApmTracer($configuration, new CurlReporter('http://apm-server:8200'), new MemoryEventPool());

$transactionId = $tracer->startTransaction('create.user', 'command');
sleep(1);
$secondTransactionId = $tracer->startTransaction('find.user', 'query');
$spanId = $tracer->startSpan('a span test', 'comm');
sleep(1);
$tracer->stopSpan($spanId);
sleep(1);
$tracer->stopTransaction($secondTransactionId, 'OK');
sleep(1);
$tracer->stopTransaction($transactionId, 'OK');

$tracer->flush();
