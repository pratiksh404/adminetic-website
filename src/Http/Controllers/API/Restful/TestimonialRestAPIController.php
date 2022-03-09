<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Contracts\TestimonialRepositoryInterface;
use Adminetic\Website\Http\Requests\TestimonialRequest;
use Adminetic\Website\Models\Admin\Testimonial;
use App\Http\Controllers\Controller;

class TestimonialRestAPIController extends Controller
{
    protected $testimonialRepositoryInterface;

    public function __construct(TestimonialRepositoryInterface $testimonialRepositoryInterface)
    {
        $this->testimonialRepositoryInterface = $testimonialRepositoryInterface;
        $this->authorizeResource(Testimonial::class, 'testimonial');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->testimonialRepositoryInterface->indexTestimonial(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\TestimonialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialRequest $request)
    {
        $testimonial = $this->testimonialRepositoryInterface->storeTestimonial($request);

        return response()->json($testimonial, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return response()->json($testimonial, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\TestimonialRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        $this->testimonialRepositoryInterface->updateTestimonial($request, $testimonial);

        return response()->json($testimonial, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $deleted_item = $testimonial;
        $testimonial->delete();

        return response()->json($deleted_item, 200);
    }
}
