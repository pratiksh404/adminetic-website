<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Facility;
use Adminetic\Website\Http\Requests\FacilityRequest;
use Adminetic\Website\Contracts\FacilityRepositoryInterface;

class FacilityController extends Controller
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
        return view('website::admin.facility.index', $this->facilityRepositoryInterface->indexFacility());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.facility.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Counter  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacilityRequest $request)
    {
        $this->facilityRepositoryInterface->storeFacility($request);
        return redirect(adminRedirectRoute('facility'))->withSuccess('Facility Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        return view('website::admin.facility.show', $this->facilityRepositoryInterface->showFacility($facility));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit(Facility $facility)
    {
        return view('website::admin.facility.edit', $this->facilityRepositoryInterface->editFacility($facility));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Counter  $request
     * @param  \Adminetic\Website\Models\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(FacilityRequest $request, Facility $facility)
    {
        $this->facilityRepositoryInterface->updateFacility($request, $facility);
        return redirect(adminRedirectRoute('facility'))->withInfo('Facility Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        $this->facilityRepositoryInterface->destroyFacility($facility);
        return redirect(adminRedirectRoute('facility'))->withFail('Facility Deleted Successfully.');
    }

    /**
     *
     * Reorder Category Model Data
     *
     */
    public function reorder_facilities(Request $request)
    {
        foreach ($request->input('rows', []) as $row) {
            Facility::find($row['id'])->update([
                'position' => $row['position']
            ]);
        }

        return response()->noContent();
    }
}
