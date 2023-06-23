<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\PageRepositoryInterface;
use Adminetic\Website\Http\Requests\PageRequest;
use Adminetic\Website\Models\Admin\Page;
use Illuminate\Support\Facades\Cache;

class PageRepository implements PageRepositoryInterface
{
    // Page Index
    public function indexPage()
    {
        $pages = config('adminetic.caching', true)
            ? (Cache::has('pages') ? Cache::get('pages') : Cache::rememberForever('pages', function () {
                return Page::orderBy('position')->get();
            }))
            : Page::orderBy('position')->get();

        return compact('pages');
    }

    // Page Create
    public function createPage()
    {
        //
    }

    // Page Store
    public function storePage(PageRequest $request)
    {
        $page = Page::create($request->validated());
        $this->uploadImage($page);
    }

    // Page Show
    public function showPage(Page $page)
    {
        return compact('page');
    }

    // Page Edit
    public function editPage(Page $page)
    {
        return compact('page');
    }

    // Page Update
    public function updatePage(PageRequest $request, Page $page)
    {
        $page->update($request->validated());
        $this->uploadImage($page);
    }

    // Page Destroy
    public function destroyPage(Page $page)
    {
        $page->delete();
    }

    // Upload Image
    private function uploadImage(Page $page)
    {
        if (request()->has('image')) {
            $page
                ->addFromMediaLibraryRequest(request()->image)
                ->toMediaCollection('image');
        }
        if (request()->has('icon_image')) {
            $page
                ->addFromMediaLibraryRequest(request()->icon_image)
                ->toMediaCollection('icon_image');
        }
    }
}
