<?php

namespace Adminetic\Website\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class PostPreference
{
    public static function trackVisitedPost(Request $request, $post_id)
    {
        $visited_posts = [];
        if (isset($post_id)) {
            if (self::checkCookieConsent()) {
                if (self::getCookie($request) !== null) {
                    $visited_posts = self::getCookie($request);
                    array_push($visited_posts, $post_id);
                } else {
                    array_push($visited_posts, $post_id);
                    self::setCookie(json_encode($visited_posts));
                }
            }
        }
    }

    // Get Visited Posts ID
    public static function getVisitedPostsID(Request $request)
    {
        return self::getCookie($request);
    }

    // Check Cookie Consent
    protected static function checkCookieConsent(): bool
    {
        return (bool) Cookie::get('laravel_cookie_consent');
    }

    protected static function setCookie($value)
    {
        $response = new Response('Set Cookie');
        $response->withCookie(cookie()->forever('visited_posts', $value));

        return $response;
    }

    protected static function getCookie(Request $request)
    {
        return json_decode($request->cookie('visited_posts'));
    }
}
