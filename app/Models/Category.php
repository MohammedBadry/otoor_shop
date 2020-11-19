<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use App\Models\Concerns\HasOffers;
use Spatie\MediaLibrary\HasMedia;
use App\Support\Traits\Selectable;
use App\Models\Scopes\CategoryScopes;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Relations\CategoryRelations;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Http\Filters\Categories\CategoryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model implements TranslatableContract, HasMedia
{
    use HasFactory;
    use Filterable;
    use Translatable;
    use InteractsWithMedia;
    use HasUploader;
    use CategoryRelations;
    use Selectable;
    use CategoryScopes;
    use HasOffers;

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
        'parent_id',
        'country_id',
        'display_in_navbar',
    ];

    /**
     * The query parameter's filter of the model.
     *
     * @var string
     */
    protected $filter = CategoryFilter::class;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'display_in_navbar' => 'boolean',
    ];
}
