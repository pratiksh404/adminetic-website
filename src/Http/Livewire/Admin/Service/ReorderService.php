<?php

namespace Adminetic\Website\Http\Livewire\Admin\Service;

use Adminetic\Website\Models\Admin\Service;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ReorderService extends Component
{
    public function updateServiceOrder($lists)
    {
        foreach ($lists as $list) {
            Service::find($list['value'])->update(['position' => $list['order']]);
        }
        $this->emit('reorderingComplete');
    }

    public function render()
    {
        $services = Cache::get('services', Service::orderBy('position')->get());

        return view('website::livewire.admin.service.reorder-service', compact('services'));
    }
}
