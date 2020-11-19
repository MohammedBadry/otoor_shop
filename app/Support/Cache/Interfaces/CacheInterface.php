<?php

namespace App\Support\Cache\Interfaces;

use Closure;

interface CacheInterface
{
    /**
     * Store an item in the cache.
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function put($key, $value);

    /**
     * Retrieve an item from the cache by key.
     *
     * @param $key
     * @param \Closure|null $value
     * @return mixed
     */
    public function get($key, Closure $value = null);

    /**
     * Remove all items from the cache.
     *
     * @return void
     */
    public function flush();
}
