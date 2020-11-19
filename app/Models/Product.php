<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use Spatie\MediaLibrary\HasMedia;
use App\Models\Concerns\HasOffers;
use App\Support\Traits\Selectable;
use App\Models\Concerns\HasDiscount;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Relations\ProductRelations;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Http\Filters\Products\ProductFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements HasMedia, TranslatableContract
{
    use HasFactory;
    use ProductRelations;
    use InteractsWithMedia;
    use HasUploader;
    use Filterable;
    use Translatable;
    use HasDiscount;
    use Selectable;

    /**
     * The translated attributes that are mass assignable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'name',
        'description',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id',
        'category_id',
        'price',
    ];

    /**
     * The query parameter's filter of the model.
     *
     * @var string
     */
    protected $filter = ProductFilter::class;

    /**
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('default')
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->width(70)
                    ->format('png');

                $this->addMediaConversion('small')
                    ->width(120)
                    ->format('png');

                $this->addMediaConversion('medium')
                    ->width(160)
                    ->format('png');

                $this->addMediaConversion('large')
                    ->width(320)
                    ->format('png');
            });
    }

    public function getDashboardUrl()
    {
        return route('dashboard.products.show', $this);
    }

    public function getWebUrl()
    {
        return url('products/'. $this->id);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = (float) str_replace(',', '', $value);
    }
}
