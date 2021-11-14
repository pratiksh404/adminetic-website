<?php

namespace Adminetic\Website\Http\Livewire\Admin\Popup;

use Adminetic\Website\Models\Admin\Popup;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ReorderPopup extends Component
{
    public function updatePopupOrder($lists)
    {
        foreach ($lists as $list) {
            Popup::find($list['value'])->update(['position' => $list['order']]);
        }
        $this->emit('reorderingComplete');
    }

    public function render()
    {
        $popups = Cache::get('popups', Popup::orderBy('position')->get());

        return view('website::livewire.admin.popup.reorder-popup', compact('popups'));
    }
}
