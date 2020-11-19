<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use App\Models\Concerns\HasDiscount;
use Spatie\MediaLibrary\HasMedia;
use App\Support\Traits\Selectable;
use App\Http\Filters\Collections\CollectionFilter;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Collection extends Model implements HasMedia, TranslatableContract
{
    use HasFactory;
    use Translatable;
    use InteractsWithMedia;
    use HasUploader;
    use Filterable;
    use Selectable;
    use Selectable;
    use HasDiscount;

    /**
     * The translated attributes that are mass assignable.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'price',
    ];

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
    protected $filter = CollectionFilter::class;

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
                $this->addMediaConversion('large')
                    ->width(600)
                    ->nonQueued();

                $this->addMediaConversion('medium')
                    ->width(300)
                    ->nonQueued();

                $this->addMediaConversion('thumb')
                    ->width(100)
                    ->nonQueued();
            });
    }

    public function getDashboardUrl()
    {
        return route('dashboard.collections.show', $this);
    }

    public function getWebUrl()
    {
        return url('collections/'.$this->id);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = (float) str_replace(',', '', $value);
    }
}
