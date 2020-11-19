<?php

use App\Models\Country;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Support\Cache\CacheFactory;

if (! function_exists('validate_base64')) {
    /**
     * Validate a base64 content.
     *
     * @param string $base64data
     * @param array $allowedMime example ['png', 'jpg', 'jpeg']
     * @return bool
     */
    function validate_base64($base64data, array $allowedMime)
    {
        // strip out data uri scheme information (see RFC 2397)
        if (strpos($base64data, ';base64') !== false) {
            [, $base64data] = explode(';', $base64data);
            [, $base64data] = explode(',', $base64data);
        }

        // strict mode filters for non-base64 alphabet characters
        if (base64_decode($base64data, true) === false) {
            return false;
        }

        // decoding and then reeconding should not change the data
        if (base64_encode(base64_decode($base64data)) !== $base64data) {
            return false;
        }

        $binaryData = base64_decode($base64data);

        // temporarily store the decoded data on the filesystem to be able to pass it to the fileAdder
        $tmpFile = tempnam(sys_get_temp_dir(), 'medialibrary');
        file_put_contents($tmpFile, $binaryData);

        // guard Against Invalid MimeType
        $allowedMime = Arr::flatten($allowedMime);

        // no allowedMimeTypes, then any type would be ok
        if (empty($allowedMime)) {
            return true;
        }

        // Check the MimeTypes
        $validation = Illuminate\Support\Facades\Validator::make(
            ['file' => new Illuminate\Http\File($tmpFile)],
            ['file' => 'mimes:'.implode(',', $allowedMime)]
        );

        return ! $validation->fails();
    }
}

if (! function_exists('random_or_create')) {
    /**
     * Get random instance for the given model class or create new.
     *
     * @param string $model
     * @param int $count
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    function random_or_create($model, $count = null, $attributes = [])
    {
        $instance = new $model;

        if (! $instance->count()) {
            return factory($model, $count)->create($attributes);
        }

        if (count($attributes)) {
            foreach ($attributes as $key => $value) {
                $instance = $instance->where($key, $value);
            }
        }

        return $instance->get()->random();
    }
}

if (! function_exists('price')) {
    /**
     * Retrieve the given price with the given currency.
     *
     * @param $price
     * @return string
     */
    function price($price)
    {
        return \App\Support\Money::make($price)->formatted();
    }
};

if (! function_exists('country')) {
    /**
     * Retrieve the client's country or default country .
     *
     * @return \App\Models\Country
     */
    function country()
    {
        if ($country = optional(Route::current())->parameter('country')) {
            return $country;
        }
        $clientCountryCode = Str::lower(
            geoip()->getLocation()->getAttribute('iso_code')
        );

        return CacheFactory::make('country')
            ->get(
                $clientCountryCode.'.country',
                function () use ($clientCountryCode) {
                    return Country::where('code', $clientCountryCode)
                        ->orWhere('is_default', true)
                        ->firstOrNew();
                }
            );
    }
}

if (! function_exists('currency')) {
    /**
     * Retrieve the client's currency or default currency .
     *
     * @return \App\Models\Currency
     */
    function currency()
    {
        if ($code = session('currency', request()->header('accept-currency', request('currency')))) {
            return \App\Models\Currency::whereCode($code)->firstOrNew();
        }
        return \App\Models\Currency::default()->firstOrNew();
    }
}
