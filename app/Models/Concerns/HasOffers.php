<?php

namespace App\Models\Concerns;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Model;

trait HasOffers
{
    /**
     * Retrieve the model's offers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function offers()
    {
        return $this->morphMany(Offer::class, 'target');
    }

    /**
     * Retrieve the model's available offer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function availableOffer()
    {
        return $this->morphOne(Offer::class, 'target')
            ->whereDate('from', '<=', now())
            ->where('to', '>=', now());
    }

    /**
     * Boot the trait on the model.
     *
     * @throws \Exception
     * @return void
     */
    protected static function bootHasOffers()
    {
        static::deleting(function (Model $target) {
            if (! $target->forceDeleting) {
                return;
            }

            $target->offers()->cursor()->each(fn (Offer $offer) => $offer->delete());
        });
    }
}
