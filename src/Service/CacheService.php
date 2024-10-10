<?php

namespace UserCredit\Service;

class CacheService
{
    private $cache = [];

    public function set(string $key, $value): void
    {
        $this->cache[$key] = $value;
    }

    public function get(string $key)
    {
        return $this->cache[$key] ?? null;
    }
}
