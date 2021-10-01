<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\CounterRequest;
use Adminetic\Website\Models\Admin\Counter;

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
