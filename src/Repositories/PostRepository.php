<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\PostRepositoryInterface;
use Adminetic\Website\Http\Requests\PostRequest;
use Adminetic\Website\Models\Admin\Post;
use Adminetic\Website\Models\Admin\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PostRepository implements PostRepositoryInterface
{
    // Post Index
    public function indexPost()
    {
        $posts = config('adminetic.caching', true)
            ? (Cache::has('posts') ? Cache::get('posts') : Cache::rememberForever('posts', function () {
                return Post::orderBy('position')->get();
            }))
            : Post::orderBy('position')->get();

        return compact('posts');
    }

    // Post Create
    public function createPost()
    {
        $tags = Tag::latest()->get();

        return compact('tags');
    }

    // Post Store
    public function storePost(PostRequest $request)
    {
        $post = Post::create($request->validated());
        $this->syncTags($post);
        $this->uploadImage($post);
    }

    // Post Show
    public function showPost(Post $post)
    {
        return compact('post');
    }

    // Post Edit
    public function editPost(Post $post)
    {
        $tags = Tag::latest()->get();

        return compact('post', 'tags');
    }

    // Post Update
    public function updatePost(PostRequest $request, Post $post)
    {
        $post->update($request->validated());
        $this->syncTags($post);
        $this->uploadImage($post);
    }

    // Post Destroy
    public function destroyPost(Post $post)
    {
        $post->tags()->detach();
        $post->delete();
    }

    // Upload Image
    private function uploadImage(Post $post)
    {
        if (request()->has('image')) {
            $post
                ->addFromMediaLibraryRequest(request()->image)
                ->toMediaCollection('image');
        }
    }

    // Tags
    private function syncTags(Post $post)
    {
        if (request()->has('tags')) {
            $post->tags()->detach();
            foreach (request()->tags as $tag_name) {
                $tag = Tag::firstOrCreate([
                    'name' => trim($tag_name),
                    'slug' => Str::slug(trim($tag_name)),
                ]);
                $post->tags()->attach($tag->id);
            }
        }
    }
}
