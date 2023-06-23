<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Models\Admin\Counter;
use Illuminate\Support\Facades\Cache;
use Adminetic\Website\Contracts\CounterRepositoryInterface;
use Adminetic\Website\Http\Requests\CounterRequest;

class CounterRepository implements CounterRepositoryInterface
{
    // Counter Index
    public function indexCounter()
    {
        $counters = config('adminetic.caching', true)
            ? (Cache::has('counters') ? Cache::get('counters') : Cache::rememberForever('counters', function () {
                return Counter::orderBy('position')->get();
            }))
            : Counter::orderBy('position')->get();
        return compact('counters');
    }

    // Counter Create
    public function createCounter()
    {
        //
    }

    // Counter Store
    public function storeCounter(CounterRequest $request)
    {
        $counter = Counter::create($request->validated());
        $this->uploadImage($counter);
    }

    // Counter Show
    public function showCounter(Counter $counter)
    {
        return compact('counter');
    }

    // Counter Edit
    public function editCounter(Counter $counter)
    {
        return compact('counter');
    }

    // Counter Update
    public function updateCounter(CounterRequest $request, Counter $counter)
    {
        $counter->update($request->validated());
        $this->uploadImage($counter);
    }

    // Counter Destroy
    public function destroyCounter(Counter $counter)
    {
        $counter->delete();
    }

    // Upload Image
    private function uploadImage(Counter $counter)
    {
        if (request()->has('icon_image')) {
            $counter
                ->addFromMediaLibraryRequest(request()->icon_image)
                ->toMediaCollection('icon_image');
        }
    }
}
