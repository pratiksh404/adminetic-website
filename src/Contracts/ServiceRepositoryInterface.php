<?php

namespace App\Contracts;

use App\Models\Admin\Service;
use App\Http\Requests\ServiceRequest;

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
