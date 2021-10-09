<?php

namespace Adminetic\Website\Http\Livewire\Admin\Post;

use Livewire\Component;
use Adminetic\Website\Models\Admin\Post;

class PostStatus extends Component
{
    public $post;

    protected $listeners = ['status_changed' => 'statusChanged'];


    public function statusChanged($status, Post $post)
    {
        $post->update([
            'status' => $status
        ]);

        $this->post = $post;
    }

    public function render()
    {
        return view('website::livewire.admin.post.post-status');
    }
}
