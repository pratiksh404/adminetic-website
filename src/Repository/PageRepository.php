<?php

namespace Adminetic\Website\Repository;

use Adminetic\Website\Models\Admin\Page;
use Illuminate\Support\Facades\Cache;
use Adminetic\Website\Contracts\PageRepositoryInterface;
use Adminetic\Website\Http\Requests\PageRequest;

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
        $page->image ? $page->hardDelete('image') : '';
        $page->delete();
    }

    // Upload Image
    protected function uploadImage(Page $page)
    {
        if (request()->image) {
            $thumbnails = [
                'storage' => 'website/page/' . validImageFolder($page->type, 'post'),
                'width' => '1200',
                'height' => '630',
                'quality' => '90',
                'thumbnails' => [
                    [
                        'thumbnail-name' => 'medium',
                        'thumbnail-width' => '600',
                        'thumbnail-height' => '315',
                        'thumbnail-quality' => '70'
                    ],
                    [
                        'thumbnail-name' => 'small',
                        'thumbnail-width' => '100',
                        'thumbnail-height' => '80',
                        'thumbnail-quality' => '30'
                    ]
                ]
            ];
            $page->makeThumbnail('image', $thumbnails);
        }
    }
}
