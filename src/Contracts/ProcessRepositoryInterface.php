<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\ProcessRequest;
use Adminetic\Website\Models\Admin\Process;

interface ProcessRepositoryInterface
{
    public function indexProcess();

    public function createProcess();

    public function storeProcess(ProcessRequest $request);

    public function showProcess(Process $Process);

    public function editProcess(Process $Process);

    public function updateProcess(ProcessRequest $request, Process $Process);

    public function destroyProcess(Process $Process);
}
