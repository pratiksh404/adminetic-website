<?php

namespace Adminetic\Website\Http\Livewire\Admin\Video;

use Adminetic\Website\Models\Admin\Video;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ReorderVideo extends Component
{
    public function updateVideoOrder($lists)
    {
        foreach ($lists as $list) {
            Video::find($list['value'])->update(['position' => $list['order']]);
        }
        $this->emit('reorderingComplete');
    }

    public function render()
    {
        $videos = Cache::get('videos', Video::orderBy('position')->get());

        return view('website::livewire.admin.video.reorder-video', compact('videos'));
    }
}
