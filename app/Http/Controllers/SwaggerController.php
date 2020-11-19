<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SwaggerController extends Controller
{
    /**
     * Display the swagger generated documentation as a json.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $openapi = require base_path('openapi/documentation.php');

        Storage::put(storage_path('/api-docs/api-docs.json'), $openapi->toJson());

        return $openapi->toArray();
    }
}
