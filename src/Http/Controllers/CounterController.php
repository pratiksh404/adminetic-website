<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Counter;
use App\Contracts\CounterRepositoryInterface;
use Adminetic\Website\Http\Requests\CounterRequest;

class CounterController extends Controller
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
        return view('website::admin.counter.index', $this->counterRepositoryInterface->indexCounter());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.counter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\CounterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CounterRequest $request)
    {
        $this->counterRepositoryInterface->storeCounter($request);
        return redirect(adminRedirectRoute('counter'))->withSuccess('Counter Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function show(Counter $counter)
    {
        return view('website::admin.counter.show', $this->counterRepositoryInterface->showCounter($counter));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function edit(Counter $counter)
    {
        return view('website::admin.counter.edit', $this->counterRepositoryInterface->editCounter($counter));
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
        return redirect(adminRedirectRoute('counter'))->withInfo('Counter Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Counter $counter)
    {
        $this->counterRepositoryInterface->destroyCounter($counter);
        return redirect(adminRedirectRoute('counter'))->withFail('Counter Deleted Successfully.');
    }
}
