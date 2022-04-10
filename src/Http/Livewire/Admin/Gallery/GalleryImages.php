<?php

namespace Adminetic\Website\Http\Livewire\Admin\Gallery;

use Adminetic\Website\Models\Admin\Gallery;
use Adminetic\Website\Models\Admin\Image;
use Livewire\Component;

class GalleryImages extends Component
{
    public $gallery_id;

    protected $listeners = ['delete_gallery_image' => 'deleteGalleryImage'];

    public function mount($gallery_id = null)
    {
        $this->gallery_id = $gallery_id;
    }

    public function deleteGalleryImage($id)
    {
        $image = Image::find($id);
        if (isset($image)) {
            $image->delete();
            $this->emit('galleryImageDeleted');
        }
    }

    public function imagePositionReorder($lists)
    {
        foreach ($lists as $list) {
            Image::find($list['value'])->update(['position' => $list['order']]);
        }
        $this->emit('reorderingComplete');
    }

    public function render()
    {
        $gallery = Gallery::find($this->gallery_id);

        return view('website::livewire.admin.gallery.gallery-images', compact('gallery'));
    }
}
