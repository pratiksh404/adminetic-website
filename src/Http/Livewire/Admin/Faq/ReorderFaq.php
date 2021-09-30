<?php

namespace Adminetic\Website\Http\Livewire\Admin\Faq;

use Livewire\Component;
use Adminetic\Website\Models\Admin\Faq;
use Illuminate\Support\Facades\Cache;

class ReorderFaq extends Component
{
    public function updateFaqOrder($lists)
    {
        foreach ($lists as $list) {
            Faq::find($list['value'])->update(['position' => $list['order']]);
        }
        $this->emit('reorderingComplete');
    }

    public function render()
    {
        $faqs = Cache::get('faqs', Faq::orderBy('position')->get());
        return view('website::livewire.admin.faq.reorder-faq', compact('faqs'));
    }
}
