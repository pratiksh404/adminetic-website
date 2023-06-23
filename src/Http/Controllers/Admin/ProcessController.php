<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Contracts\ProcessRepositoryInterface;
use Adminetic\Website\Http\Requests\ProcessRequest;
use Adminetic\Website\Models\Admin\Process;
use App\Http\Controllers\Controller;

class ProcessController extends Controller
{
    protected $processRepositoryInterface;

    public function __construct(ProcessRepositoryInterface $processRepositoryInterface)
    {
        $this->processRepositoryInterface = $processRepositoryInterface;
        $this->authorizeResource(Process::class, 'process');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.process.index', $this->processRepositoryInterface->indexProcess());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.process.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ProcessRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcessRequest $request)
    {
        $this->processRepositoryInterface->storeProcess($request);

        return redirect(adminRedirectRoute('process'))->withSuccess('Process Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function show(Process $process)
    {
        return view('website::admin.process.show', $this->processRepositoryInterface->showProcess($process));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function edit(Process $process)
    {
        return view('website::admin.process.edit', $this->processRepositoryInterface->editProcess($process));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ProcessRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function update(ProcessRequest $request, Process $process)
    {
        $this->processRepositoryInterface->updateProcess($request, $process);

        return redirect(adminRedirectRoute('process'))->withInfo('Process Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function destroy(Process $process)
    {
        $this->processRepositoryInterface->destroyProcess($process);

        return redirect(adminRedirectRoute('process'))->withFail('Process Deleted Successfully.');
    }
}
