<?php

namespace App\Http\Controllers;

use App\Models\Tester;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TesterController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Tester $tester
     * @return \Illuminate\Http\Response
     */
    public function show(Tester $tester)
    {
        return view('testers.show', get_defined_vars());
    }
}
