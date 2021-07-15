<?php

namespace App\Contracts;

use Adminetic\Website\Models\Admin\Counter;
use Adminetic\Website\Http\Requests\CounterRequest;

interface CounterRepositoryInterface
{
    public function indexCounter();

    public function createCounter();

    public function storeCounter(CounterRequest $request);

    public function showCounter(Counter $Counter);

    public function editCounter(Counter $Counter);

    public function updateCounter(CounterRequest $request, Counter $Counter);

    public function destroyCounter(Counter $Counter);
}
