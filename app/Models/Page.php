<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use App\Support\Traits\Selectable;
use App\Http\Filters\Pages\PageFilter;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Page extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    use Filterable;
    use Selectable;

    /**
     * The translated attributes that are mass assignable.
     *
     * @var array
     */
    public $translatedAttributes = ['name', 'description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'name',
    ];

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
    protected $filter = PageFilter::class;
}
