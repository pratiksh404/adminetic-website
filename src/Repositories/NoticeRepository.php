<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Models\Admin\Notice;
use Illuminate\Support\Facades\Cache;
use Adminetic\Website\Contracts\NoticeRepositoryInterface;
use Adminetic\Website\Http\Requests\NoticeRequest;

class NoticeRepository implements NoticeRepositoryInterface
{
    // Notice Index
    public function indexNotice()
    {
        $notices = config('adminetic.caching', true)
            ? (Cache::has('notices') ? Cache::get('notices') : Cache::rememberForever('notices', function () {
                return Notice::orderBy('position')->get();
            }))
            : Notice::orderBy('position')->get();
        return compact('notices');
    }

    // Notice Create
    public function createNotice()
    {
        //
    }

    // Notice Store
    public function storeNotice(NoticeRequest $request)
    {
        $notice = Notice::create($request->validated());
        $this->uploadImage($notice);
    }

    // Notice Show
    public function showNotice(Notice $notice)
    {
        return compact('notice');
    }

    // Notice Edit
    public function editNotice(Notice $notice)
    {
        return compact('notice');
    }

    // Notice Update
    public function updateNotice(NoticeRequest $request, Notice $notice)
    {
        $notice->update($request->validated());
        $this->uploadImage($notice);
    }

    // Notice Destroy
    public function destroyNotice(Notice $notice)
    {
        $notice->delete();
    }

    // Upload Image
    private function uploadImage(Notice $notice)
    {
        if (request()->has('image')) {
            $notice
                ->addFromMediaLibraryRequest(request()->image)
                ->toMediaCollection('image');
        }
        if (request()->has('icon_image')) {
            $notice
                ->addFromMediaLibraryRequest(request()->icon_image)
                ->toMediaCollection('icon_image');
        }
    }
}
