<?php

namespace Adminetic\Website\Http\Controllers;

use Adminetic\Website\Contracts\FeatureRepositoryInterface;
use Adminetic\Website\Http\Requests\FeatureRequest;
use Adminetic\Website\Models\Admin\Feature;
use App\Http\Controllers\Controller;

class FeatureController extends Controller
{
    protected $featureRepositoryInterface;

    public function __construct(FeatureRepositoryInterface $featureRepositoryInterface)
    {
        $this->featureRepositoryInterface = $featureRepositoryInterface;
        $this->authorizeResource(Feature::class, 'feature');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.feature.index', $this->featureRepositoryInterface->indexFeature());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\FeatureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeatureRequest $request)
    {
        $this->featureRepositoryInterface->storeFeature($request);

        return redirect(adminRedirectRoute('feature'))->withSuccess('Feature Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        return view('website::admin.feature.show', $this->featureRepositoryInterface->showFeature($feature));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature)
    {
        return view('website::admin.feature.edit', $this->featureRepositoryInterface->editFeature($feature));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\FeatureRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(FeatureRequest $request, Feature $feature)
    {
        $this->featureRepositoryInterface->updateFeature($request, $feature);

        return redirect(adminRedirectRoute('feature'))->withInfo('Feature Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
        $this->featureRepositoryInterface->destroyFeature($feature);

        return redirect(adminRedirectRoute('feature'))->withFail('Feature Deleted Successfully.');
    }
}
