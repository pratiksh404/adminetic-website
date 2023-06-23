<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Models\Admin\Career;
use Adminetic\Website\Http\Requests\CareerRequest;

interface CareerRepositoryInterface
{
    public function indexCareer();

    public function createCareer();

    public function storeCareer(CareerRequest $request);

    public function showCareer(Career $Career);

    public function editCareer(Career $Career);

    public function updateCareer(CareerRequest $request, Career $Career);

    public function destroyCareer(Career $Career);
}
