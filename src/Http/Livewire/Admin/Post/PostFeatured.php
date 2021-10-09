<?php

namespace Adminetic\Website\Http\Livewire\Admin\Post;

use Livewire\Component;
use Adminetic\Website\Models\Admin\Post;

class PostFeatured extends Component
{
    public $post;

    protected $listeners = ['featured_changed' => 'featuredChanged'];


    public function featuredChanged(Post $post)
    {
        $post->update([
            'featured' => !$post->featured
        ]);

        $this->post = $post;
    }

    public function render()
    {
        return view('website::livewire.admin.post.post-featured');
    }
}
