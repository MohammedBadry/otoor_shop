<?php

namespace App\Support\Cache;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Support\Cache\Interfaces\CacheInterface;

class CacheServices implements CacheInterface
{
    /**
     * The name of the tag operation.
     *
     * @var string
     */
    protected $tag;

    /**
     * The drivers that support the cache tags operation.
     *
     * @var array
     */
    protected $supportedDrivers = ['redis', 'memcached'];

    /**
     * Begin executing a new tags operation if the store supports it.
     *
     * @param $key
     * @return $this
     */
    public function setTag($key)
    {
        $this->tag = $key;

        return $this;
    }

    /**
     * Get the tag operation.
     *
     * @return string
     */
    protected function getTag()
    {
        return $this->tag;
    }

    /**
     * Store an item in the cache.
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function put($key, $value)
    {
        if (! $this->supportCaching()) {
            return $value;
        }

        Cache::tags($this->getTag())->put($key, $value, $this->getLifetime());

        return $value;
    }

    /**
     * Determine whether the given key was cached.
     *
     * @param mixed $key
     * @return bool
     */
    public function wasCached($key)
    {
        return $this->supportCaching()
            && Cache::tags($this->getTag())->has($key);
    }

    /**
     * Retrieve an item from the cache by key.
     *
     * @param $key
     * @param \Closure|null $value
     * @return mixed
     */
    public function get($key, Closure $value = null)
    {
        if ($this->wasCached($key)) {
            return Cache::tags($this->getTag())->get($key);
        }

        if ($value) {
            return $this->put($key, $value());
        }

        return null;
    }

    /**
     * Remove all items from the cache.
     *
     * @return void
     */
    public function flush()
    {
        Cache::tags($this->getTag())->flush();
    }

    /**
     * Determine wither the cache driver is supported.
     *
     * @return bool
     */
    protected function supportCaching()
    {
        return in_array(
            Cache::getDefaultDriver(),
            $this->supportedDrivers
        );
    }

    /**
     * The cache expiration time.
     *
     * @return \Carbon\Carbon
     */
    protected function getLifetime()
    {
        return Carbon::now()->addHours(2);
    }
}
