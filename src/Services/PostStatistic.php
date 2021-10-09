<?php

namespace Adminetic\Website\Services;

use Adminetic\Website\Models\Admin\Post;

class PostStatistic
{
    public static function dashboard()
    {
        $total_posts = Post::tenent()->count();
        $total_published_posts = Post::tenent()->published()->count();
        $total_pending_posts = Post::tenent()->pending()->count();
        $total_draft_posts = Post::tenent()->draft()->count();

        $total_featured_posts = Post::tenent()->featured()->count();
        $total_hot_news = Post::tenent()->hotNews()->count();
        $total_breaking_news = Post::tenent()->breakingNews()->count();
        $total_video_posts = Post::tenent()->video()->count();

        $most_viewed_posts = Post::tenent()->with('category')->published()->orderByViews()->take(10)->get();

        return compact('total_posts', 'total_published_posts', 'total_pending_posts', 'total_draft_posts', 'total_featured_posts', 'total_hot_news', 'total_breaking_news', 'total_video_posts', 'most_viewed_posts');
    }
    public static function perMonthTotalPosterCount(Poster $poster, $given_year = null)
    {
        $perMonthTotal = [];
        $year = $given_year ?? Carbon::now()->year;

        foreach (range(1, Carbon::now()->month) as $month) {
            $start_date = Carbon::create($year, $month, 1);
            $end_date = $start_date->copy()->endOfMonth();
            $perMonthTotal[Carbon::create($year, $month, 1)->format('F')] = views($poster)
                ->period(Period::create($start_date->toDateString(), $end_date->toDateString()))
                ->count();
        }
        return $perMonthTotal;
    }

    public static function perMonthTotalPostCount(Post $post, $given_year = null)
    {
        $perMonthTotal = [];
        $year = $given_year ?? Carbon::now()->year;

        foreach (range(1, Carbon::now()->month) as $month) {
            $start_date = Carbon::create($year, $month, 1);
            $end_date = $start_date->copy()->endOfMonth();
            $perMonthTotal[Carbon::create($year, $month, 1)->format('F')] = views($post)
                ->period(Period::create($start_date->toDateString(), $end_date->toDateString()))
                ->count();
        }
        return $perMonthTotal;
    }

    public static function perMonthAllTotalPostCount($given_year = null)
    {
        $perMonthTotal = [];
        $year = $given_year ?? Carbon::now()->year;
        foreach (range(1, Carbon::now()->month) as $month) {
            $start_date = Carbon::create($year, $month, 1);
            $end_date = $start_date->copy()->endOfMonth();
            $perMonthTotal[Carbon::create($year, $month, 1)->format('F')] = views(new Post())
                ->period(Period::create($start_date->toDateString(), $end_date->toDateString()))
                ->count();
        }
        return $perMonthTotal;
    }

    public static function perMonthAllTotalTenentPostCount($given_year = null)
    {
        $perMonthTotal = [];
        $year = $given_year ?? Carbon::now()->year;
        foreach (range(1, Carbon::now()->month) as $month) {
            $start_date = Carbon::create($year, $month, 1);
            $end_date = $start_date->copy()->endOfMonth();
            $total_count = 0;
            $posts = Post::tenent()->published()->get();
            foreach ($posts as $post) {
                $count = views($post)
                    ->period(Period::create($start_date->toDateString(), $end_date->toDateString()))
                    ->count();
                $total_count += $count;
            }
            $perMonthTotal[Carbon::create($year, $month, 1)->format('F')] = $total_count;
        }
        return $perMonthTotal;
    }
}
