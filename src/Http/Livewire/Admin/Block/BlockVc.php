<?php

namespace Adminetic\Website\Http\Livewire\Admin\Block;

use Adminetic\Website\Models\Admin\Block;
use Livewire\Component;

class BlockVc extends Component
{
    public $activeblocks = [];

    public function mount()
    {
        $activeblocks = [];
        $block_groups = Block::where('active', 1)->get()->groupBy(['theme', 'type']);
        foreach ($block_groups as $theme => $types) {
            foreach ($types as $type => $blocks) {
                foreach ($blocks as $block) {
                    $activeblocks[$theme][$type] = $block->id;
                }
            }
        }
        $this->activeblocks = $activeblocks;
    }

    public function updateBlockOrder($lists)
    {
        foreach ($lists as $list) {
            Block::find($list['value'])->update(['position' => $list['order']]);
        }
        $this->emit('reorderingComplete');
    }

    public function updatedActiveblocks()
    {
        $block_ids = [];
        foreach ($this->activeblocks as $types) {
            foreach ($types as $type => $block_id) {
                $block_ids[] = $block_id;
            }
        }

        if (isset($block_ids)) {
            foreach ($block_ids as $block_id) {
                $block = Block::find($block_id);
                $block->update(['active' => 1]);
                $blocks = Block::where([
                    ['id', '<>', $block->id],
                    ['type', '=', $block->type],
                    ['theme', '=', $block->theme],
                ])->pluck('id')->toArray();

                Block::whereIn('id', $blocks)->update(['active' => 0]);
            }
            $this->emit('blockVcComplete');
        }
    }

    public function render()
    {
        $blocks = Block::all()->groupBy(['theme', 'type']);

        return view('website::livewire.admin.block.block-vc', compact('blocks'));
    }
}
