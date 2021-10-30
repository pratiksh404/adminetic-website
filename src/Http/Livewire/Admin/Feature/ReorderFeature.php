<?php

namespace Adminetic\Website\Http\Livewire\Admin\Feature;

use Adminetic\Website\Models\Admin\Feature;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ReorderFeature extends Component
{
    public function updateFeatureOrder($lists)
    {
        foreach ($lists as $list) {
            Feature::find($list['value'])->update(['position' => $list['order']]);
        }
        $this->emit('reorderingComplete');
    }

    public function render()
    {
        $features = Cache::get('features', Feature::orderBy('position')->get());

        return view('website::livewire.admin.feature.reorder-feature', compact('features'));
    }
}
