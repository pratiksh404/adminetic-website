<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Models\Admin\Testimonial;
use Adminetic\Website\Http\Resources\Testimonial\TestimonialCollection;
use Adminetic\Website\Http\Resources\Testimonial\TestimonialResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestimonialClientAPIController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TestimonialCollection(Testimonial::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return new TestimonialResource($testimonial);
    }
}
