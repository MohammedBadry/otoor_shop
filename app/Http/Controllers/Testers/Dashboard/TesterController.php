<?php

namespace App\Http\Controllers\Testers\Dashboard;

use App\Models\Tester;
use Illuminate\Routing\Controller;
use App\Http\Requests\Testers\TesterRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TesterController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * TesterController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Tester::class, 'tester');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testers = Tester::filter()->paginate();

        return view('dashboard.testers.index', compact('testers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.testers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Testers\TesterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TesterRequest $request)
    {
        $tester = Tester::create($request->all());

        $tester->addAllMediaFromTokens();

        $tester->products()->sync($request->products);

        flash(trans('testers.messages.created'));

        return redirect()->route('dashboard.testers.show', $tester);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tester $tester
     * @return \Illuminate\Http\Response
     */
    public function show(Tester $tester)
    {
        $offers = $tester->offers()->paginate();

        return view('dashboard.testers.show', compact('tester', 'offers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Tester $tester
     * @return \Illuminate\Http\Response
     */
    public function edit(Tester $tester)
    {
        return view('dashboard.testers.edit', compact('tester'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Testers\TesterRequest $request
     * @param \App\Models\Tester $tester
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TesterRequest $request, Tester $tester)
    {
        $tester->update($request->all());

        $tester->addAllMediaFromTokens();

        $tester->products()->sync($request->products);

        flash(trans('testers.messages.updated'));

        return redirect()->route('dashboard.testers.show', $tester);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Tester $tester
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tester $tester)
    {
        $tester->delete();

        flash(trans('testers.messages.deleted'));

        return redirect()->route('dashboard.testers.index');
    }
}
