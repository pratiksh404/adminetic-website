<?php

namespace Adminetic\Website\Http\Livewire\Admin\Package;

use Livewire\Component;

class PackageFeature extends Component
{
    public $package;
    public $features;

    public function mount($package = null)
    {
        $this->package = $package;
        $this->features = isset($package->data['features']) ? $package->data['features'] : null;
    }

    public function addFeature()
    {
        $features =  $this->features;
        $features[] = [
            'name' => '',
            'included' => true,
        ];
        $this->features = $features;
    }

    public function removeFeature($index)
    {
        $features =  $this->features;
        unset($features[$index]);
        $this->features = $features;
    }

    public function render()
    {
        return view('website::livewire.admin.package.package-feature');
    }
}
