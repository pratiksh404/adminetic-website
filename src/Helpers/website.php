<?php

use Adminetic\Website\Models\Admin\Post;
use Adminetic\Website\Models\Admin\Service;
use Adminetic\Website\Models\Admin\Software;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Spatie\SchemaOrg\Article;
use Spatie\SchemaOrg\Graph;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\Service as SchemaOrgService;
use Spatie\SchemaOrg\SoftwareApplication;

// Search Schema

if (! function_exists('about_organization_schema')) {
    function about_organization_schema()
    {
        $org = Schema::organization()
            ->name(title())
            ->alternateName('DTI')
            ->address(address())
            ->phone(phone())
            ->email(email())
            ->image(logoBanner())
            ->logo(logo());

        return $org->toScript();
    }
}

if (! function_exists('services_schema')) {
    function services_schema()
    {
        $graph = new Graph();
        $services = Cache::get('services', Service::orderBy('position')->get());
        foreach ($services as $service) {
            $graph->service(str_replace(' ', '', $service->name), function (SchemaOrgService $schema, Graph $graph) use ($service): void {
                $schema
                    ->name($service->meta_name ?? $service->name)
                    ->description($service->meta_description ?? $service->excerpt)
                    ->url(route('website.service', ['service' => $service->slug]))
                    ->keywords($service->meta_keywords);
            });
        }

        return $graph->toScript();
    }
}

if (! function_exists('software_schema')) {
    function software_schema()
    {
        $graph = new Graph();
        $software = Cache::get('software', Software::orderBy('position')->get());
        foreach ($software as $sw) {
            $modules = isset($sw->data['modules']) ? $sw->data['modules'] : null;
            $graph->softwareApplication(str_replace(' ', '', $sw->name), function (SoftwareApplication $schema, Graph $graph) use ($sw, $modules): void {
                $schema
                    ->name($sw->meta_name ?? $sw->name)
                    ->author(title())
                    ->description($sw->meta_description ?? $sw->excerpt)
                    ->image($sw->banner)
                    ->if(! is_null($modules), function (SoftwareApplication $schema) use ($modules) {
                        $schema->email(collect($modules)->pluck('name')->toArray());
                    })
                    ->url(route('website.software', ['software' => $sw->slug]))
                    ->keywords($sw->meta_keywords);
            });
        }

        return $graph->toScript();
    }
}

if (! function_exists('posts_schema')) {
    function posts_schema()
    {
        $graph = new Graph();
        $posts = Cache::get('posts', Post::published()->orderBy('position')->get());
        foreach ($posts as $post) {
            $graph->article(str_replace(' ', '', $post->name), function (Article $schema, Graph $graph) use ($post): void {
                $schema
                    ->name($post->meta_name ?? $post->name)
                    ->description($post->meta_description ?? $post->excerpt)
                    ->if(! is_null($post->getFirstMedia('image')), function (Article $schema) use ($post) {
                        $schema->image($post->getFirstMediaUrl('image'));
                    })
                    ->keywords($post->meta_keywords);
            });
        }

        return $graph->toScript();
    }
}

if (! function_exists('dateMode')) {
    function dateMode()
    {
        $mode = config('adminetic.cache_mode', true) ?
            Cache::has('date_mode') ? Cache::get('date_mode') : Cache::rememberForever('date_mode', function () {
                return setting('date_mode', config('website.date_mode', 'bs'));
            })
            : setting('date_mode', config('website.date_mode', 'bs'));

        return $mode;
    }
}

if (! function_exists('modeDate')) {
    function modeDate(Carbon $date)
    {
        return dateMode() == 'bs' ? nepaliDate($date) : $date->toFormattedDateString();
    }
}

if (! function_exists('currency')) {
    function currency()
    {
        return setting('currency', config('website.currency', 'Rs.'));
    }
}

if (! function_exists('short_description')) {
    function short_description()
    {
        return setting('short_description', config('website.short_description', null));
    }
}

if (! function_exists('description')) {
    function description()
    {
        return setting('description', config('website.description', null));
    }
}

if (! function_exists('map')) {
    function map()
    {
        return setting('map', config('website.map', null));
    }
}

if (! function_exists('phone')) {
    function phone()
    {
        return setting('phone', config('website.phone', ''));
    }
}

if (! function_exists('email')) {
    function email()
    {
        return setting('email', config('website.email', ''));
    }
}

if (! function_exists('address')) {
    function address()
    {
        return setting('address', config('website.address', ''));
    }
}

if (! function_exists('keywords')) {
    function keywords()
    {
        return setting('keywords', config('website.keywords', 'event management, doctype innovations'));
    }
}

if (! function_exists('opening_hour')) {
    function opening_hour()
    {
        return setting('opening_hour', config('website.opening_hour', '9am to 6pm'));
    }
}

if (! function_exists('facebook')) {
    function facebook()
    {
        return setting('facebook', config('website.facebook', 'https://www.facebook.com/doctypenepal'));
    }
}

if (! function_exists('email')) {
    function email()
    {
        return setting('email', config('website.email', 'doctypeinnovation@gmail.com'));
    }
}

if (! function_exists('facebook_messenger')) {
    function facebook_messenger()
    {
        return setting('facebook_messenger', config('website.facebook_messenger', 'https://m.me/doctypenepal'));
    }
}

if (! function_exists('parseYoutube')) {
    function parseYoutube($video)
    {
        return preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" style="width: 100%;height: 30vh;" src="//www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe></div>', $video);
    }
}

if (! function_exists('services')) {
    function services()
    {
        return Cache::get('services', Service::orderBy('position')->get());
    }
}

if (! function_exists('software')) {
    function software()
    {
        return Cache::get('software', Software::orderBy('position')->get());
    }
}
