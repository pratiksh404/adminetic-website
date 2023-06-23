<?php

namespace Adminetic\Website\Http\Livewire\Admin\Gallery;

use Livewire\Component;

class GalleryVideo extends Component
{
    public $gallery;
    public $videos = [];

    public function mount($gallery = null)
    {
        $this->gallery = $gallery;
        $this->videos = isset($gallery->videos) ? $gallery->videos : null;
    }

    public function addVideos()
    {
        $videos = $this->videos;
        $videos[] = null;
        $this->videos = $videos;
    }

    public function removeVideo($index)
    {
        $videos = $this->videos;
        unset($videos[$index]);
        $this->videos = $videos;
    }

    public function removeAllVideo()
    {
        $this->videos = null;
    }

    public function render()
    {
        return view('website::livewire.admin.gallery.gallery-video');
    }
}
