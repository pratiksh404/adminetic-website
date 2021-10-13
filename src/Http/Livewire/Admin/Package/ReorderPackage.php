<?php

namespace Adminetic\Website\Http\Livewire\Admin\Package;

use Adminetic\Website\Models\Admin\Package;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ReorderPackage extends Component
{
    public function updatePackageOrder($lists)
    {
        foreach ($lists as $list) {
            Package::find($list['value'])->update(['position' => $list['order']]);
        }
        $this->emit('reorderingComplete');
    }

    public function render()
    {
        $packages = Cache::get('packages', Package::orderBy('position')->get());

        return view('website::livewire.admin.package.reorder-package', compact('packages'));
    }
}
