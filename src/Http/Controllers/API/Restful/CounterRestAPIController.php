<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Contracts\CounterRepositoryInterface;
use Adminetic\Website\Http\Requests\CounterRequest;
use Adminetic\Website\Models\Admin\Counter;
use App\Http\Controllers\Controller;

class CounterRestAPIController extends Controller
{
    protected $counterRepositoryInterface;

    public function __construct(CounterRepositoryInterface $counterRepositoryInterface)
    {
        $this->counterRepositoryInterface = $counterRepositoryInterface;
        $this->authorizeResource(Counter::class, 'counter');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->counterRepositoryInterface->indexCounter(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\CounterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CounterRequest $request)
    {
        $counter = $this->counterRepositoryInterface->storeCounter($request);

        return response()->json($counter, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function show(Counter $counter)
    {
        return response()->json($counter, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\CounterRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function update(CounterRequest $request, Counter $counter)
    {
        $this->counterRepositoryInterface->updateCounter($request, $counter);

        return response()->json($counter, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Counter $counter)
    {
        $deleted_item = $counter;
        $counter->delete();

        return response()->json($deleted_item, 200);
    }
}
