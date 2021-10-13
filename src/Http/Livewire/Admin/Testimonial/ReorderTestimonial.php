<?php

namespace Adminetic\Website\Http\Livewire\Admin\Testimonial;

use Adminetic\Website\Models\Admin\Testimonial;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ReorderTestimonial extends Component
{
    public function updateTestimonialOrder($lists)
    {
        foreach ($lists as $list) {
            Testimonial::find($list['value'])->update(['position' => $list['order']]);
        }
        $this->emit('reorderingComplete');
    }

    public function render()
    {
        $testimonials = Cache::get('testimonials', Testimonial::orderBy('position')->get());

        return view('website::livewire.admin.testimonial.reorder-testimonial', compact('testimonials'));
    }
}
