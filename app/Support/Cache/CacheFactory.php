<?php

namespace App\Support\Cache;

class CacheFactory
{
    /**
     * Create the cache services instance.
     *
     * @param mixed $tag
     * @return \App\Support\Cache\CacheServices
     */
    public static function make($tag)
    {
        return app(CacheServices::class)->setTag($tag);
    }
}
