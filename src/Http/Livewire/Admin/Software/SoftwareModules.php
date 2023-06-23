<?php

namespace Adminetic\Website\Http\Livewire\Admin\Software;

use Livewire\Component;

class SoftwareModules extends Component
{
    public $modules = [];
    public $software;

    public function mount($software)
    {
        if (! is_null($software)) {
            $this->software = $software;
            $data = $software->data;
            $this->modules = $data['modules'] ?? null;
        }
    }

    public function addModule()
    {
        $this->modules[] = [
            'name' => 'Module 1',
            'color' => '#7366FF',
            'icon' => 'fa fa-plug',
            'description' => null,
        ];
    }

    public function removeModule($index)
    {
        $modules = $this->modules;
        unset($modules[$index]);
        $this->modules = $modules;
    }

    public function render()
    {
        return view('website::livewire.admin.software.software-modules');
    }
}
