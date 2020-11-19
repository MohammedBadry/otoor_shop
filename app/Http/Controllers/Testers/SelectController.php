<?php

namespace App\Http\Controllers\Testers;

use App\Models\Tester;
use Illuminate\Routing\Controller;
use App\Http\Filters\Testers\SelectFilter;
use App\Http\Resources\Testers\SelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Filters\Testers\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(SelectFilter $filter)
    {
        $testers = Tester::filter($filter)->paginate();

        return SelectResource::collection($testers);
    }
}
