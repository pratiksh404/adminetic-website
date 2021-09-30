<?php

namespace Adminetic\Website\Http\Livewire\Admin\Facility;

use Livewire\Component;
use Adminetic\Website\Models\Admin\Facility;
use Illuminate\Support\Facades\Cache;

class ReorderFacility extends Component
{
    public function updateFacilityOrder($lists)
    {
        foreach ($lists as $list) {
            Facility::find($list['value'])->update(['position' => $list['order']]);
        }
        $this->emit('reorderingComplete');
    }

    public function render()
    {
        $facilities = Cache::get('facilities', Facility::orderBy('position')->get());
        return view('website::livewire.admin.facility.reorder-facility', compact('facilities'));
    }
}
