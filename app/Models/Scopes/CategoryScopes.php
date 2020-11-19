<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category parentsOnly()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category leafsOnly()
 */
trait CategoryScopes
{
    /**
     * Scope the query to include parent categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeParentsOnly(Builder $builder)
    {
        return $builder->doesntHave('parent');
    }

    /**
     * Scope the query to include leaf categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLeafsOnly(Builder $builder)
    {
        return $builder->doesntHave('subcategories');
    }
}
