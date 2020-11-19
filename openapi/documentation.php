<?php

use GoldSpecDigital\ObjectOrientedOAS\OpenApi;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Info;

// Create the info section.
$info = Info::create()
    ->title(config('app.name'))
    ->version('v1');

[$search, $clearCache] = require 'schemas.php';

// Create the main OpenAPI object composed off everything created above.
$openApi = OpenApi::create()
    ->openapi(OpenApi::OPENAPI_3_0_2)
    ->info($info)
    ->paths(
        $search,
        $clearCache
    );

return $openApi;
