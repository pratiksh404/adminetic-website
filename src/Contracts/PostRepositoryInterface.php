<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\PostRequest;
use Adminetic\Website\Models\Admin\Post;

interface PostRepositoryInterface
{
    public function indexPost();

    public function createPost();

    public function storePost(PostRequest $request);

    public function showPost(Post $Post);

    public function editPost(Post $Post);

    public function updatePost(PostRequest $request, Post $Post);

    public function destroyPost(Post $Post);
}
