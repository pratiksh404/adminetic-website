<?php

namespace Adminetic\Website\Http\Livewire\Admin\Post;

use Adminetic\Website\Models\Admin\Post;
use Livewire\Component;

class PostFeatured extends Component
{
    public $post;

    protected $listeners = ['featured_changed' => 'featuredChanged'];

    public function featuredChanged(Post $post)
    {
        $post->update([
            'featured' => ! $post->featured,
        ]);

        $this->post = $post;
    }

    public function render()
    {
        return view('website::livewire.admin.post.post-featured');
    }
}
