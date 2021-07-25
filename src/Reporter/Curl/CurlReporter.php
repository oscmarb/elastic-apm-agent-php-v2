<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Reporter\Curl;

use Oscmarb\ElasticApm\Reporter\Reporter;
use Oscmarb\ElasticApm\Reporter\ReporterException;
use Oscmarb\ElasticApm\Utils\Compressor;
use Oscmarb\ElasticApm\Utils\NDJson;

class CurlReporter implements Reporter
{
    private const METHOD = 'POST';
    private const URI = '/intake/v2/events';

    public function __construct(private ?string $baseUri)
    {
    }

    public function report(array $events): void
    {
        $url = $this->getUrl();

        $body = Compressor::gzip(NDJson::convert($events));
        $headers = $this->getHttpHeaders($this->getHeaders($body));

        $ch = curl_init($url);

        if (false === $ch) {
            throw new \Exception('Could not initialize the curl handler.');
        }

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, self::METHOD);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpStatusCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if (202 !== $httpStatusCode) {
            throw new ReporterException($response, $httpStatusCode);
        }
    }

    private function getUrl(): string
    {
        return sprintf(
            '%s%s',
            $this->baseUri,
            self::URI
        );
    }

    private function getHttpHeaders(array $headers): array
    {
        return array_map(
            static function ($key, $value) {
                return sprintf(
                    '%s: %s',
                    $key,
                    $value
                );
            },
            array_keys($headers),
            array_values($headers)
        );
    }

    private function getHeaders(string $body): array
    {
        return array_merge(
            $this->defaultRequestHeaders(),
            [
                'Content-Length' => strlen($body),
            ]
        );
    }

    private function defaultRequestHeaders(): array
    {
        return [
            'Content-Type' => NDJson::contentType(),
            'Content-Encoding' => 'gzip',
            'User-Agent' => sprintf('%s/%s', 'test', '1.0'),
            'Accept' => 'application/json',
        ];
    }
}