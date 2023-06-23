<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\DownloadRepositoryInterface;
use Adminetic\Website\Http\Requests\DownloadRequest;
use Adminetic\Website\Models\Admin\Download;
use Illuminate\Support\Facades\Cache;

class DownloadRepository implements DownloadRepositoryInterface
{
    // Download Index
    public function indexDownload()
    {
        $downloads = config('adminetic.caching', true)
            ? (Cache::has('downloads') ? Cache::get('downloads') : Cache::rememberForever('downloads', function () {
                return Download::orderBy('position')->get();
            }))
            : Download::orderBy('position')->get();

        return compact('downloads');
    }

    // Download Create
    public function createDownload()
    {
        //
    }

    // Download Store
    public function storeDownload(DownloadRequest $request)
    {
        $download = Download::create($request->validated());
        $this->uploadFile($download);
    }

    // Download Show
    public function showDownload(Download $download)
    {
        return compact('download');
    }

    // Download Edit
    public function editDownload(Download $download)
    {
        return compact('download');
    }

    // Download Update
    public function updateDownload(DownloadRequest $request, Download $download)
    {
        $download->update($request->validated());
        $this->uploadFile($download);
    }

    // Download Destroy
    public function destroyDownload(Download $download)
    {
        $download->delete();
    }

    // Upload Image
    private function uploadFile(Download $download)
    {
        if (request()->has('file')) {
            $download
                ->addFromMediaLibraryRequest(request()->file)
                ->toMediaCollection('file');
        }
    }
}
