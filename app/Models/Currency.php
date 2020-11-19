<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\Currencies\CurrencyFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Currency extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    use Filterable;

    /**
     * The translated attributes that are mass assignable.
     *
     * @var array
     */
    public $translatedAttributes = ['name', 'symbol'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];

    /**
     * The query parameter's filter of the model.
     *
     * @var string
     */
    protected $filter = CurrencyFilter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'code',
        'is_default',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_default' => 'boolean',
    ];

    /**
     * Retrieve all the currency rates.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rates()
    {
        return $this->hasMany(CurrencyExchangeRate::class, 'currency_from');
    }

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Handle saving event, it fire when creating and updating.
        static::saving(function (self $currency) {
            // Determine default currency if not exists.
            if (self::where('is_default', true)->doesntExist()) {
                $currency->forceFill(['is_default' => true]);
            }

            // If other currency marked as default, replace the default currency with it.
            if ($currency->is_default) {
                Country::withoutEvents(function () {
                    Country::where('is_default', true)->update([
                        'is_default' => null,
                    ]);
                });

                $currency->forceFill(['is_default' => true]);
            }
        });
    }

    /**
     * Scope the query to include only default currency.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDefault(Builder $builder)
    {
        return $builder->where('is_default', true);
    }
}
