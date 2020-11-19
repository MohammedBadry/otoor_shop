<?php

namespace App\Http\Filters\Products;

use App\Http\Filters\BaseFilters;
use Illuminate\Support\Arr;

/**
 * @property \Illuminate\Database\Eloquent\Builder|\App\Models\Product $builder
 */
class ProductFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'name',
        'price_from',
        'price_to',
        'categories',
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

    protected function priceFrom($value)
    {
        if ($value) {
            return $this->builder->where('price', '>=', $value);
        }

        return $this->builder;
    }

    protected function priceTo($value)
    {
        if ($value) {
            return $this->builder->where('price', '<=', $value);
        }

        return $this->builder;
    }

    protected function categories($value)
    {
        if ($value) {
            return $this->builder->whereHas('categories', function ($query) use ($value) {
                $query->whereIn('category_id', '<=', Arr::wrap($value));
            });
        }

        return $this->builder;
    }
}
