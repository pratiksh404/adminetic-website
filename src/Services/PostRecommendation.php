<?php

namespace Adminetic\Website\Services;

use Adminetic\Website\Models\Admin\Post;
use Illuminate\Support\Facades\Cache;

class PostRecommendation
{

    public static function recommendedPosts(Post $post, $limit = 6)
    {
        $posts = Cache::get('posts', Post::with('category', 'author', 'tagged')->latest()->get());

        return $posts->sortByDesc(function ($p) use ($post) {
            $post_tags = $post->tags->pluck('name')->toArray();
            $tag_weight = $p->withAnyTag($post_tags)->exists() ? (5 / 100) * $p->weight : 0;
            $category_weight = $p->category->id == $post->category_id ? (10 / 100) * $p->weight : 0;
            $weight = $p->weight + $tag_weight + $category_weight;
            return $weight;
        })->take($limit);
    }

    public static function postWeight(Post $post)
    {
        $post_views_weight = config('coderz.post_views_weight', 5);
        $post_priority_weight = config('coderz.post_priority_weight', 2);
        $category_view_weight = config('coderz.category_view_weight', 2);
        $featured_post_weight = config('coderz.featured_post_weight', 15);
        $hot_news_weight = config('coderz.hot_news_weight', 10);

        $post_views = views($post)->count();
        $post_views_total_weight = ($post_views / 5) * $post_views_weight;

        $post_priority_total_weight = $post->priority * $post_priority_weight;

        $post_category_views = views($post->category)->count();
        $category_view_total_weight = ($post_category_views / 5) * $category_view_weight;

        $post_total_weight = $post_views_total_weight + $post_priority_total_weight + $category_view_total_weight + $featured_post_weight + $hot_news_weight;

        return $post_total_weight;
    }
}
