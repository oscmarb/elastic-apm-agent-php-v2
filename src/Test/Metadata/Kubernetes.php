<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Metadata;

class Kubernetes implements \JsonSerializable
{
    public function __construct(
        private ?string $namespace,
        private ?KubernetesNode $node,
        private ?KubernetesPod $pod
    ) {
    }

    public function namespace(): ?string
    {
        return $this->namespace;
    }

    public function node(): ?KubernetesNode
    {
        return $this->node;
    }

    public function pod(): ?KubernetesPod
    {
        return $this->pod;
    }

    public function jsonSerialize(): array
    {
        return [
            'namespace' => $this->namespace,
            'node' => $this->node,
            'pod' => $this->pod,
        ];
    }
}