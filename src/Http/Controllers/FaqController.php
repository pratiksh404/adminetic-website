<?php

namespace Adminetic\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Faq;
use Adminetic\Website\Http\Requests\FaqRequest;
use Adminetic\Website\Contracts\FaqRepositoryInterface;

class FaqController extends Controller
{
    protected $faqRepositoryInterface;

    public function __construct(FaqRepositoryInterface $faqRepositoryInterface)
    {
        $this->faqRepositoryInterface = $faqRepositoryInterface;
        $this->authorizeResource(Faq::class, 'faq');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.faq.index', $this->faqRepositoryInterface->indexFaq());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Faq  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $this->faqRepositoryInterface->storeFaq($request);
        return redirect(adminRedirectRoute('faq'))->withSuccess('Faq Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return view('website::admin.faq.show', $this->faqRepositoryInterface->showFaq($faq));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('website::admin.faq.edit', $this->faqRepositoryInterface->editFaq($faq));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Faq  $request
     * @param  \Adminetic\Website\Models\Admin\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $this->faqRepositoryInterface->updateFaq($request, $faq);
        return redirect(adminRedirectRoute('faq'))->withInfo('Faq Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $this->faqRepositoryInterface->destroyFaq($faq);
        return redirect(adminRedirectRoute('faq'))->withFail('Faq Deleted Successfully.');
    }
}
