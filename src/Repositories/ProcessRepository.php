<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\ProcessRepositoryInterface;
use Adminetic\Website\Http\Requests\ProcessRequest;
use Adminetic\Website\Models\Admin\Process;
use Illuminate\Support\Facades\Cache;

class ProcessRepository implements ProcessRepositoryInterface
{
    // Process Index
    public function indexProcess()
    {
        $processes = config('adminetic.caching', true)
            ? (Cache::has('processes') ? Cache::get('processes') : Cache::rememberForever('processes', function () {
                return Process::orderBy('position')->get();
            }))
            : Process::orderBy('position')->get();

        return compact('processes');
    }

    // Process Create
    public function createProcess()
    {
        //
    }

    // Process Store
    public function storeProcess(ProcessRequest $request)
    {
        Process::create($request->validated());
    }

    // Process Show
    public function showProcess(Process $process)
    {
        return compact('process');
    }

    // Process Edit
    public function editProcess(Process $process)
    {
        return compact('process');
    }

    // Process Update
    public function updateProcess(ProcessRequest $request, Process $process)
    {
        $process->update($request->validated());
    }

    // Process Destroy
    public function destroyProcess(Process $process)
    {
        $process->delete();
    }
}
