<?php

namespace Adminetic\Website\Http\Livewire\Admin\Page;

use Livewire\Component;
use Adminetic\Website\Models\Admin\Page;
use Illuminate\Support\Facades\Cache;

class ReorderPage extends Component
{
    public function updatePageOrder($lists)
    {
        foreach ($lists as $list) {
            Page::find($list['value'])->update(['position' => $list['order']]);
        }
        $this->emit('reorderingComplete');
    }

    public function render()
    {
        $pages = Cache::get('pages', Page::orderBy('position')->get());
        return view('website::livewire.admin.page.reorder-page', compact('pages'));
    }
}
