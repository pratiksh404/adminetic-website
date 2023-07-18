<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Contracts\HistoryRepositoryInterface;
use Adminetic\Website\Http\Requests\HistoryRequest;
use Adminetic\Website\Models\Admin\History;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    protected $historyRepositoryInterface;

    public function __construct(HistoryRepositoryInterface $historyRepositoryInterface)
    {
        $this->historyRepositoryInterface = $historyRepositoryInterface;
        $this->authorizeResource(History::class, 'history');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.history.index', $this->historyRepositoryInterface->indexHistory());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.history.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\HistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HistoryRequest $request)
    {
        $this->historyRepositoryInterface->storeHistory($request);

        return redirect(adminRedirectRoute('history'))->withSuccess('History Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        return view('website::admin.history.show', $this->historyRepositoryInterface->showHistory($history));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        return view('website::admin.history.edit', $this->historyRepositoryInterface->editHistory($history));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\HistoryRequest  $request
     * @param  \App\Models\Admin\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(HistoryRequest $request, History $history)
    {
        $this->historyRepositoryInterface->updateHistory($request, $history);

        return redirect(adminRedirectRoute('history'))->withInfo('History Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        $this->historyRepositoryInterface->destroyHistory($history);

        return redirect(adminRedirectRoute('history'))->withFail('History Deleted Successfully.');
    }
}
