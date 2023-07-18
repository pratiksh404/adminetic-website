<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\HistoryRepositoryInterface;
use Adminetic\Website\Http\Requests\HistoryRequest;
use Adminetic\Website\Models\Admin\History;
use Illuminate\Support\Facades\Cache;

class HistoryRepository implements HistoryRepositoryInterface
{
    // History Index
    public function indexHistory()
    {
        $histories = config('adminetic.caching', true)
            ? (Cache::has('histories') ? Cache::get('histories') : Cache::rememberForever('histories', function () {
                return History::latest()->get();
            }))
            : History::latest()->get();

        return compact('histories');
    }

    // History Create
    public function createHistory()
    {
        //
    }

    // History Store
    public function storeHistory(HistoryRequest $request)
    {
        $history = History::create($request->validated());
        $this->uploadImage($history);
    }

    // History Show
    public function showHistory(History $history)
    {
        return compact('history');
    }

    // History Edit
    public function editHistory(History $history)
    {
        return compact('history');
    }

    // History Update
    public function updateHistory(HistoryRequest $request, History $history)
    {
        $history->update($request->validated());
        $this->uploadImage($history);
    }

    // History Destroy
    public function destroyHistory(History $history)
    {
        $history->delete();
    }

    // Upload Image
    private function uploadImage(History $history)
    {
        if (request()->has('image')) {
            $history
                ->addFromMediaLibraryRequest(request()->image)
                ->toMediaCollection('image');
        }
    }
}
