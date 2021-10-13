<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\ServiceRepositoryInterface;
use Adminetic\Website\Http\Requests\ServiceRequest;
use Adminetic\Website\Models\Admin\Service;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ServiceRepository implements ServiceRepositoryInterface
{
    // Service Index
    public function indexService()
    {
        $services = config('adminetic.caching', true)
            ? (Cache::has('services') ? Cache::get('services') : Cache::rememberForever('services', function () {
                return Service::orderBy('position')->get();
            }))
            : Service::orderBy('position')->get();

        return compact('services');
    }

    // Service Create
    public function createService()
    {
        //
    }

    // Service Store
    public function storeService(ServiceRequest $request)
    {
        $service = Service::create($request->validated());
        $this->uploadImage($service);
    }

    // Service Show
    public function showService(Service $service)
    {
        return compact('service');
    }

    // Service Edit
    public function editService(Service $service)
    {
        return compact('service');
    }

    // Service Update
    public function updateService(ServiceRequest $request, Service $service)
    {
        $service->update($request->validated());
        $this->uploadImage($service);
    }

    // Service Destroy
    public function destroyService(Service $service)
    {
        isset($service->image) ? $service->hardDelete('image') : '';
        $service->delete();
    }

    // Upload Image
    protected function uploadImage(Service $service)
    {
        if (request()->icon_image) {
            $service->update([
                'icon_image' => request()->icon_image->store('website/service/image', 'public'),
            ]);
            $image = Image::make(request()->file('icon_image')->getRealPath());
            $image->save(public_path('storage/' . $service->icon_image));
        }

        if (request()->image) {
            $thumbnails = [
                'storage' => 'website/service/icon',
                'width' => '512',
                'height' => '512',
                'quality' => '80',
                'thumbnails' => [
                    [
                        'thumbnail-name' => 'small',
                        'thumbnail-width' => '150',
                        'thumbnail-height' => '100',
                        'thumbnail-quality' => '50',
                    ],
                ],
            ];
            $service->makeThumbnail('image', $thumbnails);
        }
    }
}
