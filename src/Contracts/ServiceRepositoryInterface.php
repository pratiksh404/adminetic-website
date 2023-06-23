<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\ServiceRequest;
use Adminetic\Website\Models\Admin\Service;

interface ServiceRepositoryInterface
{
    public function indexService();

    public function createService();

    public function storeService(ServiceRequest $request);

    public function showService(Service $Service);

    public function editService(Service $Service);

    public function updateService(ServiceRequest $request, Service $Service);

    public function destroyService(Service $Service);
}
