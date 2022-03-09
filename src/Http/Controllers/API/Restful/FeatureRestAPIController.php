<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Contracts\FeatureRepositoryInterface;
use Adminetic\Website\Http\Requests\FeatureRequest;
use Adminetic\Website\Models\Admin\Feature;
use App\Http\Controllers\Controller;

class FeatureRestAPIController extends Controller
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
        return response()->json($this->featureRepositoryInterface->indexFeature(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\FeatureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeatureRequest $request)
    {
        $feature = $this->featureRepositoryInterface->storeFeature($request);

        return response()->json($feature, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        return response()->json($feature, 200);
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

        return response()->json($feature, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
        $deleted_item = $feature;
        $feature->delete();

        return response()->json($deleted_item, 200);
    }
}
