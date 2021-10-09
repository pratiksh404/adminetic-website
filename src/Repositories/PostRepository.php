<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Models\Admin\Post;
use Illuminate\Support\Facades\Cache;
use Adminetic\Website\Models\Admin\Template;
use Adminetic\Website\Http\Requests\PostRequest;
use Adminetic\Category\Models\Admin\Category;
use Adminetic\Website\Contracts\PostRepositoryInterface;



class PostRepository implements PostRepositoryInterface
{
    // Post Index
    public function indexPost()
    {
        Cache::rememberForever('posts', function () {
            return Post::with('author')->latest()->get();
        });
        Cache::rememberForever('latest_limited_posts', function () {
            return Post::latestLimitedPosts()->get();
        });
        Cache::rememberForever('featured_limited_posts', function () {
            return Post::featuredLimitedPosts()->get();
        });
        Cache::rememberForever('limited_breaking_news', function () {
            return Post::limitedBreakingNews()->get();
        });
        Cache::rememberForever('limited_hot_news', function () {
            return Post::limitedHotNews()->get();
        });
        Cache::rememberForever('limited_trending_posts', function () {
            return Post::trending();
        });
        Cache::rememberForever('limited_priority_posts', function () {
            return Post::limitedPriorityPosts()->get();
        });
        Cache::rememberForever('yesterday_most_visited_posts', function () {
            return Post::yesterdayMostVisitedPosts()->get();
        });
        Cache::rememberForever('week_most_visited_posts', function () {
            return Post::weekMostVisitedPosts()->get();
        });
        Cache::rememberForever('most_visited_posts_chunked', function () {
            return Post::mostVisitedPostsChunked();
        });
        return [];
    }

    // Post Create
    public function createPost()
    {
        $categories = Cache::get('categories', Category::with('parent', 'categories')->latest()->get());
        $tags = Post::existingTags()->pluck('name');
        $templates = Cache::get('templates', Template::latest()->get());
        return compact('categories', 'tags', 'templates');
    }

    // Post Store
    public function storePost(PostRequest $request)
    {
        $post = Post::create($request->validated());
        if (request()->tags) {
            $post->tag(array_unique(request()->tags));
        }
        $request->image ? $this->uploadImage($post) : '';
    }

    // Post Show
    public function showPost(Post $post)
    {
        $tags = $post->tagged->pluck('tag_name');
        return compact('post', 'tags');
    }

    // Post Edit
    public function editPost(Post $post)
    {
        $categories = Cache::get('categories', Category::with('parent', 'categories')->latest()->get());
        $tags = $post->existingTags()->pluck('name');
        $remove_tags = $post->tagged->pluck('tag_name');
        $templates = Cache::get('templates', Template::latest()->get());
        return compact('post', 'categories', 'tags', 'remove_tags', 'templates');
    }

    // Post Update
    public function updatePost(PostRequest $request, Post $post)
    {
        $post->update($request->validated());
        if (request()->remove_tags) {
            $post->untag(request()->remove_tags);
        }
        if (request()->tags) {
            $post->tag(array_unique(request()->tags));
        }
        $request->image ? $this->uploadImage($post) : '';
    }

    // Post Destroy
    public function destroyPost(Post $post)
    {
        $post->image ? $post->hardDelete('image') : '';
        $post->delete();
    }

    // Upload Image
    protected function uploadImage(Post $post)
    {
        if (request()->image) {
            $thumbnails = [
                'storage' => 'website/post/' . validImageFolder($post->id, 'post'),
                'width' => '1200',
                'height' => '630',
                'quality' => '100',
                'thumbnails' => [
                    [
                        'thumbnail-name' => 'medium',
                        'thumbnail-width' => '730',
                        'thumbnail-height' => '500',
                        'thumbnail-quality' => '90'
                    ],
                    [
                        'thumbnail-name' => 'small',
                        'thumbnail-width' => '80',
                        'thumbnail-height' => '70',
                        'thumbnail-quality' => '70'
                    ]
                ]
            ];
            $post->makeThumbnail('image', $thumbnails);
        }
    }
}
