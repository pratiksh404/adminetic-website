<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Contracts\PopupRepositoryInterface;
use Adminetic\Website\Http\Requests\PopupRequest;
use Adminetic\Website\Models\Admin\Popup;
use App\Http\Controllers\Controller;

class PopupRestAPIController extends Controller
{
    protected $popupRepositoryInterface;

    public function __construct(PopupRepositoryInterface $popupRepositoryInterface)
    {
        $this->popupRepositoryInterface = $popupRepositoryInterface;
        $this->authorizeResource(Popup::class, 'popup');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->popupRepositoryInterface->indexPopup(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\PopupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PopupRequest $request)
    {
        $popup = $this->popupRepositoryInterface->storePopup($request);

        return response()->json($popup, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function show(Popup $popup)
    {
        return response()->json($popup, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\PopupRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function update(PopupRequest $request, Popup $popup)
    {
        $this->popupRepositoryInterface->updatePopup($request, $popup);

        return response()->json($popup, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Popup $popup)
    {
        $deleted_item = $popup;
        $popup->delete();

        return response()->json($deleted_item, 200);
    }
}
