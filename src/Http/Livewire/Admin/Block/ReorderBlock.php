<?php

namespace Adminetic\Website\Http\Livewire\Admin\Block;

use Adminetic\Website\Models\Admin\Block;
use Livewire\Component;

class ReorderBlock extends Component
{
    public function updateBlockOrder($lists)
    {
        foreach ($lists as $list) {
            Block::find($list['value'])->update(['position' => $list['order']]);
        }
        $this->emit('reorderingComplete');
    }

    public function render()
    {
        $blocks = Block::where('active', 1)->orderBy('position')->get();

        return view('website::livewire.admin.block.reorder-block', compact('blocks'));
    }
}
