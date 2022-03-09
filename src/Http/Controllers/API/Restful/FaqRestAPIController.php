<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Contracts\FaqRepositoryInterface;
use Adminetic\Website\Http\Requests\FaqRequest;
use Adminetic\Website\Models\Admin\Faq;
use App\Http\Controllers\Controller;

class FaqRestAPIController extends Controller
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
        return response()->json($this->faqRepositoryInterface->indexFaq(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\FaqRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $faq = $this->faqRepositoryInterface->storeFaq($request);

        return response()->json($faq, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return response()->json($faq, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\FaqRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $this->faqRepositoryInterface->updateFaq($request, $faq);

        return response()->json($faq, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $deleted_item = $faq;
        $faq->delete();

        return response()->json($deleted_item, 200);
    }
}
