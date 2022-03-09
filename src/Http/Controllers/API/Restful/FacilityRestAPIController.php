<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Contracts\FacilityRepositoryInterface;
use Adminetic\Website\Http\Requests\FacilityRequest;
use Adminetic\Website\Models\Admin\Facility;
use App\Http\Controllers\Controller;

class FacilityRestAPIController extends Controller
{
    protected $facilityRepositoryInterface;

    public function __construct(FacilityRepositoryInterface $facilityRepositoryInterface)
    {
        $this->facilityRepositoryInterface = $facilityRepositoryInterface;
        $this->authorizeResource(Facility::class, 'facility');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->facilityRepositoryInterface->indexFacility(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\FacilityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacilityRequest $request)
    {
        $facility = $this->facilityRepositoryInterface->storeFacility($request);

        return response()->json($facility, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        return response()->json($facility, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\FacilityRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(FacilityRequest $request, Facility $facility)
    {
        $this->facilityRepositoryInterface->updateFacility($request, $facility);

        return response()->json($facility, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        $deleted_item = $facility;
        $facility->delete();

        return response()->json($deleted_item, 200);
    }
}
