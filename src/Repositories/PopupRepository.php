<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Models\Admin\Popup;
use Illuminate\Support\Facades\Cache;
use Adminetic\Website\Contracts\PopupRepositoryInterface;
use Adminetic\Website\Http\Requests\PopupRequest;

class PopupRepository implements PopupRepositoryInterface
{
    // Popup Index
    public function indexPopup()
    {
        $popups = config('adminetic.caching', true)
            ? (Cache::has('popups') ? Cache::get('popups') : Cache::rememberForever('popups', function () {
                return Popup::orderBy('position')->get();
            }))
            : Popup::orderBy('position')->get();
        return compact('popups');
    }

    // Popup Create
    public function createPopup()
    {
        //
    }

    // Popup Store
    public function storePopup(PopupRequest $request)
    {
        $popup = Popup::create($request->validated());
        $this->uploadImage($popup);
    }

    // Popup Show
    public function showPopup(Popup $popup)
    {
        return compact('popup');
    }

    // Popup Edit
    public function editPopup(Popup $popup)
    {
        return compact('popup');
    }

    // Popup Update
    public function updatePopup(PopupRequest $request, Popup $popup)
    {
        $popup->update($request->validated());
        $this->uploadImage($popup);
    }

    // Popup Destroy
    public function destroyPopup(Popup $popup)
    {
        $popup->delete();
    }

    // Upload Image
    private function uploadImage(Popup $popup)
    {
        if (request()->has('image')) {
            $popup
                ->addFromMediaLibraryRequest(request()->image)
                ->toMediaCollection('image');
        }
        if (request()->has('icon_image')) {
            $popup
                ->addFromMediaLibraryRequest(request()->icon_image)
                ->toMediaCollection('icon_image');
        }
    }
}
