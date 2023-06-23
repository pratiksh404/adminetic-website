<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Models\Admin\Career;
use Adminetic\Website\Traits\HasFileUpload;
use Adminetic\Website\Http\Requests\CareerRequest;
use Illuminate\Support\Facades\Cache;
use Adminetic\Website\Contracts\CareerRepositoryInterface;

class CareerRepository implements CareerRepositoryInterface
{
    use HasFileUpload;
    // Career Index
    public function indexCareer()
    {
        $careers = config('adminetic.caching', true)
            ? (Cache::has('careers') ? Cache::get('careers') : Cache::rememberForever('careers', function () {
                return Career::orderBy('position')->get();
            }))
            : Career::orderBy('position')->get();

        return compact('careers');
    }

    // Career Create
    public function createCareer()
    {
        //
    }

    // Career Store
    public function storeCareer(CareerRequest $request)
    {
        $career = Career::create($request->validated());
        $this->uploadFiles($career);
    }

    // Career Show
    public function showCareer(Career $career)
    {
        return compact('career');
    }

    // Career Edit
    public function editCareer(Career $career)
    {
        return compact('career');
    }

    // Career Update
    public function updateCareer(CareerRequest $request, Career $career)
    {
        $career->update($request->validated());
        $this->uploadFiles($career);
    }

    // Career Destroy
    public function destroyCareer(Career $career)
    {
        $career->delete();
    }

    // Upload Files
    private function uploadFiles(Career $career)
    {
        if (request()->has('application_description')) {
            $application_description = $this->fileUpload(request()->application_description, 'website/career/' . validImageFolder($career->title), 'application_description');
            $career->update([
                'application_description' => $application_description->path
            ]);
        }
        if (request()->has('application_syllabus')) {
            $application_syllabus = $this->fileUpload(request()->application_syllabus, 'website/career/' . validImageFolder($career->title), 'application_syllabus');
            $career->update([
                'application_syllabus' => $application_syllabus->path
            ]);
        }
        if (request()->has('application_sort_list')) {
            $application_sort_list = $this->fileUpload(request()->application_sort_list, 'website/career/' . validImageFolder($career->title), 'application_sort_list');
            $career->update([
                'application_sort_list' => $application_sort_list->path
            ]);
        }
        if (request()->has('application_result')) {
            $application_result = $this->fileUpload(request()->application_result, 'website/career/' . validImageFolder($career->title), 'application_result');
            $career->update([
                'application_result' => $application_result->path
            ]);
        }
    }
}
