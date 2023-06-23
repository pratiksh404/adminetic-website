<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Models\Admin\Testimonial;
use Adminetic\Website\Http\Requests\TestimonialRequest;

interface TestimonialRepositoryInterface
{
    public function indexTestimonial();

    public function createTestimonial();

    public function storeTestimonial(TestimonialRequest $request);

    public function showTestimonial(Testimonial $Testimonial);

    public function editTestimonial(Testimonial $Testimonial);

    public function updateTestimonial(TestimonialRequest $request, Testimonial $Testimonial);

    public function destroyTestimonial(Testimonial $Testimonial);
}
