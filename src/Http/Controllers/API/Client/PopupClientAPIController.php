<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Http\Resources\Popup\PopupCollection;
use Adminetic\Website\Http\Resources\Popup\PopupResource;
use Adminetic\Website\Models\Admin\Popup;
use App\Http\Controllers\Controller;

class PopupClientAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PopupCollection(Popup::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function show(Popup $popup)
    {
        return new PopupResource($popup);
    }
}
