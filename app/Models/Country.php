<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use Spatie\MediaLibrary\HasMedia;
use App\Support\Traits\Selectable;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Http\Filters\Countries\CountryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Country extends Model implements HasMedia, TranslatableContract
{
    use HasFactory, Translatable, InteractsWithMedia, HasUploader, Filterable, Selectable;

    /**
     * The translated attributes that are mass assignable.
     *
     * @var array
     */
    public $translatedAttributes = ['name', 'currency'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'translations',
        'media',
    ];

    /**
     * The query parameter's filter of the model.
     *
     * @var string
     */
    protected $filter = CountryFilter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'code',
        'key',
        'currency',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * Retrieve all the country's categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class, 'country_id');
    }

    /**
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('flags')
            ->useFallbackUrl('https://www.countryflags.io/'.$this->code.'/shiny/64.png')
            ->singleFile();
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
        static::saving(function (Country $country) {
            // Determine default country if not exists.
            if (Country::where('is_default', true)->doesntExist()) {
                $country->forceFill(['is_default' => true]);
            }

            // If other country marked as default, replace the default country with it.
            if ($country->is_default) {
                Country::withoutEvents(function () {
                    Country::where('is_default', true)->update([
                        'is_default' => null,
                    ]);
                });

                $country->forceFill(['is_default' => true]);
            }
        });
    }

    /**
     * Scope the query to include only default country.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDefault(Builder $builder)
    {
        return $builder->where('is_default', true);
    }
}
