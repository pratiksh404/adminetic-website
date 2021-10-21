<?php

namespace Adminetic\Website\Http\Controllers;

use Adminetic\Website\Services\PostStatistic;
use Analytics;
use App\Http\Controllers\Controller;
use Spatie\Analytics\Period;

class WebsiteAnalyticsController extends Controller
{
    public function viewByCountryColumnChart()
    {
        $analytics = Analytics::performQuery(
            Period::days(request()->has('days') ? (int) request()->days : 7),
            'ga:pageviews',
            [
                'metrics' => 'ga:sessions,ga:pageviews',
                'dimensions' => 'ga:country',
                'sort' => '-ga:pageviews',
            ]
        )->rows;

        return response()->json([
            'analytics' => $analytics,
        ], 200);
    }

    public function viewByDaysColumnChart()
    {
        $analytics = Analytics::fetchTotalVisitorsAndPageViews(Period::days(request()->has('days') ? (int) request()->days : 7));

        return response()->json([
            'analytics' => $analytics,
        ], 200);
    }

    public function topReferrersColumnChart()
    {
        $analytics = Analytics::fetchTopReferrers(Period::days(request()->has('days') ? (int) request()->days : 7), 5);

        return response()->json([
            'analytics' => $analytics,
        ], 200);
    }

    public function newVsReturningVistorPieChart()
    {
        $analytics = Analytics::performQuery(
            Period::days(request()->has('days') ? (int) request()->days : 7),
            'ga:sessions',
            [
                'dimensions' => 'ga:userType',
                'metrics' => 'ga:sessions',
            ]
        )->rows;

        return response()->json([
            'analytics' => $analytics,
        ], 200);
    }

    public function topBrowsersPieChart()
    {
        $analytics = Analytics::fetchTopBrowsers(Period::days(request()->has('days') ? (int) request()->days : 7), 5);

        return response()->json([
            'analytics' => $analytics,
        ], 200);
    }

    public function mostVisitedPagesBarChart()
    {
        $analytics = Analytics::fetchMostVisitedPages(Period::days(request()->has('days') ? (int) request()->days : 7), 5);

        return response()->json([
            'analytics' => $analytics,
        ], 200);
    }

    public function getMonthlyPostTotalView()
    {
        return response()->json(['monthly_counts' => PostStatistic::perMonthAllTotalTenentPostCount()], 200);
    }
}
