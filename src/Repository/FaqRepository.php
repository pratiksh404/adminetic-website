<?php

namespace App\Repositories;

use App\Models\Admin\Faq;
use Illuminate\Support\Facades\Cache;
use App\Contracts\FaqRepositoryInterface;
use App\Http\Requests\FaqRequest;

class FaqRepository implements FaqRepositoryInterface
{
    // Faq Index
    public function indexFaq()
    {
        $faqs = config('coderz.caching', true)
            ? (Cache::has('faqs') ? Cache::get('faqs') : Cache::rememberForever('faqs', function () {
                return Faq::latest()->get();
            }))
            : Faq::latest()->get();
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
