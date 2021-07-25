<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Utils;

class Collection implements \Countable, \IteratorAggregate, \ArrayAccess
{
    private array $elements;

    public static function create(array $elements = []): self
    {
        return new self($elements);
    }

    public static function empty(): self
    {
        return self::create();
    }

    public function __construct(array $elements)
    {
        $this->elements = $elements;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @return self
     */
    public function set($key, $value): self
    {
        $this->elements[$key] = $value;

        return $this;
    }

    /**
     * @param mixed $element
     * @return self
     */
    public function add($element): self
    {
        $this->elements[] = $element;

        return $this;
    }

    /**
     * @param mixed $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->elements[$key] ?? null;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return \current($this->elements);
    }

    public function next(): void
    {
        \next($this->elements);
    }

    /**
     * @return int|string|null
     */
    public function key()
    {
        return \key($this->elements);
    }

    public function valid(): bool
    {
        if (null === $this->key()) {
            return false;
        }

        return \array_key_exists($this->key(), $this->elements);
    }


    public function rewind(): void
    {
        \reset($this->elements);
    }

    public function count(): int
    {
        return count($this->elements);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->elements);
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function containsKey($key): bool
    {
        return true === isset($this->elements[$key]) || true === array_key_exists($key, $this->elements);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return $this->containsKey($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (true === isset($offset)) {
            $this->set($offset, $value);

            return;
        }

        $this->add($value);
    }

    /**
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset($offset): void
    {
        $this->remove($offset);
    }

    /**
     * @param mixed $key
     * @return self
     */
    public function remove($key): self
    {
        if (true === $this->containsKey($key)) {
            unset($this->elements[$key]);
        }

        return $this;
    }

    /**
     * @param mixed $element
     * @return self
     */
    public function removeElement($element): self
    {
        foreach ($this->keys() as $key) {
            if ($element === $this->elements[$key]) {
                unset($this->elements[$key]);
            }
        }

        return $this;
    }

    public function walk(callable $func): self
    {
        \array_walk($this->elements, $func);

        return $this;
    }

    public function filter(callable $func, bool $keepKeys = true): self
    {
        $result = \array_filter($this->elements, $func);

        if (false === $keepKeys) {
            $result = \array_values($result);
        }

        return new self($result);
    }

    public function map(callable $func): self
    {
        return new self(\array_map($func, $this->elements));
    }

    /**
     * @param callable $func
     * @param mixed $initial
     * @return mixed
     */
    public function reduce(callable $func, $initial)
    {
        return \array_reduce($this->elements, $func, $initial);
    }

    /**
     * @param callable $func
     * @return self
     */
    public function sort(callable $func): self
    {
        $elements = $this->elements;
        \usort($elements, $func);

        return new self($elements);
    }

    /**
     * @param callable $func
     * @return mixed|null
     */
    public function find(callable $func)
    {
        foreach ($this->elements as $key => $element) {
            if (true === $func($key, $element)) {
                return $element;
            }
        }

        return null;
    }

    public function keys(): array
    {
        return \array_keys($this->elements);
    }

    public function values(): array
    {
        return \array_values($this->elements);
    }

    public function exists(callable $func): bool
    {
        foreach ($this->keys() as $key) {
            if (true === $func($key, $this->get($key))) {
                return true;
            }
        }

        return false;
    }

    public function existsValue(callable $func): bool
    {
        foreach ($this->elements as $element) {
            if (true === $func($element)) {
                return true;
            }
        }

        return false;
    }

    public function foreach(callable $func): void
    {
        foreach ($this->elements as $element) {
            $func($element);
        }
    }

    public function isEmpty(): bool
    {
        return 0 === $this->count();
    }

    public function toArray(): array
    {
        return $this->elements;
    }

    public function clone(): self
    {
        return new self($this->elements);
    }

    /**
     * @return mixed|null
     */
    public function first()
    {
        foreach ($this->elements as $element) {
            return $element;
        }

        return null;
    }
}
