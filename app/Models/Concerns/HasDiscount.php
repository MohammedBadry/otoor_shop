<?php

namespace App\Models\Concerns;

trait HasDiscount
{
    use HasOffers;

    /**
     * @param null $price
     * @return float|int|mixed|string
     */
    public function getPrice($price = null)
    {
        return ($price ?: $this->price) - $this->getDiscount();
    }

    /**
     * @param null $price
     * @return float|int
     */
    public function getDiscount($price = null)
    {
        return ($price ?: $this->price) * $this->getDiscountPercent() / 100;
    }

    /**
     * @return float|int
     */
    public function getDiscountPercent()
    {
        $percent = 0;

        if (($offer = $this->availableOffer) || ($offer = optional($this->category)->availableOffer)) {
            $percent = $offer->percent;
        }

        return $percent;
    }
}
