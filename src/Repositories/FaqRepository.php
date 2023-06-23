<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\FaqRepositoryInterface;
use Adminetic\Website\Http\Requests\FaqRequest;
use Adminetic\Website\Models\Admin\Faq;
use Illuminate\Support\Facades\Cache;

class FaqRepository implements FaqRepositoryInterface
{
    // Faq Index
    public function indexFaq()
    {
        $faqs = config('adminetic.caching', true)
            ? (Cache::has('faqs') ? Cache::get('faqs') : Cache::rememberForever('faqs', function () {
                return Faq::orderBy('position')->get();
            }))
            : Faq::orderBy('position')->get();

        return compact('faqs');
    }

    // Faq Create
    public function createFaq()
    {
        //
    }

    // Faq Store
    public function storeFaq(FaqRequest $request)
    {
        Faq::create($request->validated());
    }

    // Faq Show
    public function showFaq(Faq $faq)
    {
        return compact('faq');
    }

    // Faq Edit
    public function editFaq(Faq $faq)
    {
        return compact('faq');
    }

    // Faq Update
    public function updateFaq(FaqRequest $request, Faq $faq)
    {
        $faq->update($request->validated());
    }

    // Faq Destroy
    public function destroyFaq(Faq $faq)
    {
        $faq->delete();
    }
}
