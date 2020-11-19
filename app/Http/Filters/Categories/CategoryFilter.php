<?php

namespace App\Http\Filters\Categories;

use App\Http\Filters\BaseFilters;

/**
 * @property \Illuminate\Database\Eloquent\Builder|\App\Models\Category $builder
 */
class CategoryFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'name',
        'country_id',
        'parent_id',
    ];

    /**
     * Filter the query by a given name.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function name($value)
    {
        if ($value) {
            return $this->builder->whereTranslationLike('name', "%$value%");
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given country.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function countryId($value)
    {
        if ($value) {
            return $this->builder->where('country_id', $value);
        }

        return $this->builder;
    }

    /**
     * Filter the query by the parent category.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function parentId($value)
    {
        if ($value) {
            return $this->builder->where('parent_id', $value);
        }

        return $this->builder;
    }
}
