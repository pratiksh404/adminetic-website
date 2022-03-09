<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Http\Resources\Counter\CounterCollection;
use Adminetic\Website\Http\Resources\Counter\CounterResource;
use Adminetic\Website\Models\Admin\Counter;
use App\Http\Controllers\Controller;

class CounterClientAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CounterCollection(Counter::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function show(Counter $counter)
    {
        return new CounterResource($counter);
    }
}
