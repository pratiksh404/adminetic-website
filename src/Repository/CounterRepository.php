<?php

namespace App\Repositories;

use App\Models\Admin\Counter;
use Illuminate\Support\Facades\Cache;
use App\Contracts\CounterRepositoryInterface;
use App\Http\Requests\CounterRequest;

class CounterRepository implements CounterRepositoryInterface
{
    // Counter Index
    public function indexCounter()
    {
        $counters = config('coderz.caching', true)
            ? (Cache::has('counters') ? Cache::get('counters') : Cache::rememberForever('counters', function () {
                return Counter::latest()->get();
            }))
            : Counter::latest()->get();
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
        $counter->icon ? $counter->hardDelete('icon') : '';
        $counter->delete();
    }


    // Upload Image
    protected function uploadImage(Counter $counter)
    {
        if (request()->icon) {
            $solo_image = [
                'storage' => 'website/counter',
                'width' => '256',
                'height' => '256',
                'quality' => '80',
            ];
            $counter->uploadImage('icon', $solo_image);
        }
    }
}
