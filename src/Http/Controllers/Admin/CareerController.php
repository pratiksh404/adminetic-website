<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Models\Admin\Career;
use Illuminate\Http\Request;
use Adminetic\Website\Http\Requests\CareerRequest;
use App\Http\Controllers\Controller;
use Adminetic\Website\Contracts\CareerRepositoryInterface;
use Adminetic\Website\Models\Admin\Application;

class CareerController extends Controller
{
    protected $careerRepositoryInterface;

    public function __construct(CareerRepositoryInterface $careerRepositoryInterface)
    {
        $this->careerRepositoryInterface = $careerRepositoryInterface;
        $this->authorizeResource(Career::class, 'career');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.career.index', $this->careerRepositoryInterface->indexCareer());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.career.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\CareerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CareerRequest $request)
    {
        $this->careerRepositoryInterface->storeCareer($request);
        return redirect(adminRedirectRoute('career'))->withSuccess('Career Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function show(Career $career)
    {
        return view('website::admin.career.show', $this->careerRepositoryInterface->showCareer($career));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
        return view('website::admin.career.edit', $this->careerRepositoryInterface->editCareer($career));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\CareerRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(CareerRequest $request, Career $career)
    {
        $this->careerRepositoryInterface->updateCareer($request, $career);
        return redirect(adminRedirectRoute('career'))->withInfo('Career Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy(Career $career)
    {
        $this->careerRepositoryInterface->destroyCareer($career);
        return redirect(adminRedirectRoute('career'))->withFail('Career Deleted Successfully.');
    }

    // Career Applications
    public function applications(Career $career)
    {
        return view('website::admin.career.applications', compact('career'));
    }

    // Career Application Show
    public function application(Application $application)
    {
        return view('website::admin.application.show', compact('application'));
    }
}
