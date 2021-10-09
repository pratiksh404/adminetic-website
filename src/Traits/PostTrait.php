<?php

namespace Adminetic\Website\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait PostTrait
{
    public function scopeTenent($query)
    {
        if (Auth::user()->exists()) {
            if (! Auth::user()->hasRole('superadmin') || ! Auth::user()->hasRole('admin')) {
                return $query->where('author_id', Auth::user()->id);
            } else {
                return $query->whereNotNull('id');
            }
        } else {
            return $query->whereNotNull('id');
        }
    }

    // Drafted Posts
    public function scopeDraft($query)
    {
        return $query->where('status', 1);
    }

    // Pending Post
    public function scopePending($query)
    {
        return $query->where('status', 2);
    }

    // Published Posts
    public function scopePublished($query)
    {
        return $query->where('status', 3);
    }

    // Featured Posts
    public function scopeFeatured($query)
    {
        return $query->published()->where('featured', 1);
    }

    // Normal Posts
    public function scopeNormalPost($query)
    {
        return $query->published()->where('featured', '<>', 1);
    }

    public function scopeRelatedTagPosts($query, $id, $tags, $limit = 5)
    {
        return $query->withAnyTag($tags)->where('id', '<>', $id)->take($limit);
    }

    public function scopeRelatedCategoryPosts($query, $id, $category_id, $limit = 5)
    {
        return $query->where('category_id', $category_id)->where('id', '<>', $id)->take($limit);
    }

    public function scopeRelatedPosts($query, $id, $category_id, $tags, $limit = 5)
    {
        return $query->withAnyTag($tags)
            ->orWhere('category_id', $category_id)
            ->where('id', '<>', $id)
            ->orderByViews();
    }

    public function scopeGeneral($query)
    {
        return $query->where('type', 1);
    }

    public function scopeVideo($query)
    {
        return $query->where('type', 2)->whereNotNull('video');
    }

    public function scopeAudio($query)
    {
        return $query->where('type', 1)->whereNotNull('audio');
    }

    public function scopeBreakingNews($query)
    {
        return $query->where('breaking_news', 1);
    }

    public function scopeHotNews($query)
    {
        return $query->where('hot_news', 1);
    }

    public function scopePriority($query, $desc = true)
    {
        if ($desc) {
            return $query->orderBy('priority', 'desc');
        } else {
            return $query->orderBy('priority', 'asc');
        }
    }

    public function scopeTrending($query, $limit = 12)
    {
        return $query->with('author', 'tagged')->published()->get()->sortByDesc(function ($p) {
            return $p->weight;
        })->take($limit);
    }

    // Filter
    public function scopeToday($query)
    {
        return $query->whereDate('updated_at', Carbon::now());
    }

    public function scopeYesterday($query)
    {
        return $query->whereDate('updated_at', Carbon::yesterday());
    }

    public function scopeWeek($query)
    {
        return $query->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    }

    public function scopeMonth($query)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        return $query->whereYear('updated_at', $year)->whereMonth('updated_at', $month);
    }

    public function scopeYear($query)
    {
        $year = Carbon::now()->year;

        return $query->whereYear('updated_at', $year);
    }

    // Custom
    public function scopeLatestLimitedPosts($query, $limit = 10)
    {
        return $query->with('author', 'tagged')->published()->latest()->take($limit);
    }

    public function scopeFeaturedLimitedPosts($query, $limit = 10)
    {
        return $query->published()->featured()->with('author', 'tagged')->latest()->take($limit);
    }

    public function scopeLimitedHotNews($query, $limit = 10)
    {
        return $query->published()->hotNews()->with('author', 'tagged')->latest()->take($limit);
    }

    public function scopeLimitedBreakingNews($query, $limit = 5)
    {
        return $query->published()->breakingNews()->with('author', 'tagged')->latest()->take($limit);
    }

    public function scopeLimitedPriorityPosts($query, $limit = 10)
    {
        return $query->published()->priority()->with('author', 'tagged')->take($limit);
    }

    public function scopeYesterdayMostVisitedPosts($query, $limit = 5)
    {
        return $query->published()->with('author', 'tagged')->yesterday()->orderByViews()->take($limit);
    }

    public function scopeWeekMostVisitedPosts($query, $limit = 5)
    {
        return $query->published()->with('author', 'tagged')->week()->orderByViews()->take($limit);
    }

    public function scopeMonthMostVisitedPosts($query, $limit = 5)
    {
        return $query->published()->with('author', 'tagged')->month()->orderByViews()->take($limit);
    }

    public function scopeMostVisitedPostsChunked($query, $limit = 12)
    {
        return $query->published()->with('author', 'tagged')->orderByViews()->take($limit)->get()->chunk((int) ($limit / 2));
    }
}
