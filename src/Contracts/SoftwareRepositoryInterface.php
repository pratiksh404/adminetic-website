<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Models\Admin\Software;
use Adminetic\Website\Http\Requests\SoftwareRequest;

interface SoftwareRepositoryInterface
{
    public function indexSoftware();

    public function createSoftware();

    public function storeSoftware(SoftwareRequest $request);

    public function showSoftware(Software $Software);

    public function editSoftware(Software $Software);

    public function updateSoftware(SoftwareRequest $request, Software $Software);

    public function destroySoftware(Software $Software);
}
