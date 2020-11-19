<?php

namespace App\Http\Controllers\Testers\Api;

use App\Models\Tester;
use Illuminate\Routing\Controller;
use App\Http\Resources\Testers\TesterResource;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TesterController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the testers.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $testers = Tester::filter()->paginate();

        return TesterResource::collection($testers);
    }

    /**
     * Display the specified tester.
     *
     * @param \App\Models\Tester $tester
     * @return \App\Http\Resources\Testers\TesterResource
     */
    public function show(Tester $tester)
    {
        return new TesterResource($tester);
    }
}
