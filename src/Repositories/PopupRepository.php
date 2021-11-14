<?php

namespace Adminetic\Website\Repositories;

use Illuminate\Support\Facades\Cache;
use Adminetic\Website\Models\Admin\Popup;
use Adminetic\Website\Http\Requests\PopupRequest;
use Adminetic\Website\Contracts\PopupRepositoryInterface;
use Intervention\Image\Facades\Image;

class PopupRepository implements PopupRepositoryInterface
{
    // Popup Index
    public function indexPopup()
    {
        $popups = config('adminetic.caching', true)
            ? (Cache::has('popups') ? Cache::get('popups') : Cache::rememberForever('popups', function () {
                return Popup::latest()->get();
            }))
            : Popup::latest()->get();
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
        isset($popup->image) ? deleteImage($popup->image) : '';
        $popup->delete();
    }

    protected function uploadImage(Popup $popup)
    {
        if (request()->has('image')) {
            $popup->update([
                'image' => request()->image->store('website/popup', 'public')
            ]);
            if (request()->file('image')->getClientOriginalExtension() == 'gif') {
                $imageName = time() . '.' . request()->image->extension();

                request()->image->move(public_path('website/popup'), $imageName);
            } else {
                $image = Image::make(request()->file('image')->getRealPath());
                $image->save(public_path('storage/' . $popup->image));
            }
        }
    }
}
