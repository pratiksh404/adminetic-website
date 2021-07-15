<?php

namespace App\Contracts;

use Adminetic\Website\Models\Admin\Facility;
use Adminetic\Website\Http\Requests\FacilityRequest;

interface FacilityRepositoryInterface
{
    public function indexFacility();

    public function createFacility();

    public function storeFacility(FacilityRequest $request);

    public function showFacility(Facility $Facility);

    public function editFacility(Facility $Facility);

    public function updateFacility(FacilityRequest $request, Facility $Facility);

    public function destroyFacility(Facility $Facility);
}
