<?php

namespace Adminetic\Website\Adapter;

use Pratiksh\Adminetic\Contracts\PluginInterface;
use Pratiksh\Adminetic\Traits\SidebarHelper;

class WebsiteAdapter implements PluginInterface
{
    use SidebarHelper;

    public function assets(): array
    {
        return  [
            [
                'name' => 'IconPicker',
                'active' => true,
                'files' => [
                    [
                        'type' => 'css',
                        'active' => true,
                        'location' => 'adminetic/assets/js/icon-picker/iconpicker-1.5.0.css',
                    ],
                    [
                        'type' => 'js',
                        'active' => true,
                        'location' => 'adminetic/assets/js/icon-picker/iconpicker-1.5.0.js',
                    ],
                ],
            ],
            [
                'name' => 'Photoswipe',
                'active' => true,
                'files' => [
                    [
                        'type' => 'css',
                        'active' => true,
                        'location' => 'adminetic/assets/css/vendors/photoswipe.css',
                    ],
                    [
                        'type' => 'js',
                        'active' => true,
                        'location' => 'adminetic/assets/js/photoswipe/photoswipe.min.js',
                    ],
                    [
                        'type' => 'js',
                        'active' => true,
                        'location' => 'adminetic/assets/js/photoswipe/photoswipe-ui-default.min.js',
                    ],
                    [
                        'type' => 'js',
                        'active' => true,
                        'location' => 'adminetic/assets/js/photoswipe/photoswipe.js',
                    ],
                ],
            ],
        ];
    }

    public function myMenu(): array
    {
        return  [
            [
                'type' => 'breaker',
                'name' => 'Website',
                'description' => 'Modules',
            ],
            [
                'type' => 'menu',
                'name' => 'Services',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('service*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Service::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Service::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('service', Adminetic\Website\Models\Admin\Service::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Counters',
                'icon' => 'fa fa-plus',
                'is_active' => request()->routeIs('counter*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Counter::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Counter::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('counter', Adminetic\Website\Models\Admin\Counter::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Teams',
                'icon' => 'fa fa-users',
                'is_active' => request()->routeIs('team*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Team::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Team::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('team', Adminetic\Website\Models\Admin\Team::class),
            ],
            [
                'type' => 'menu',
                'name' => 'FAQs',
                'icon' => 'fa fa-question',
                'is_active' => request()->routeIs('faq*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Faq::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Faq::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('faq', Adminetic\Website\Models\Admin\Faq::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Packages',
                'icon' => 'fa fa-archive',
                'is_active' => request()->routeIs('package*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Package::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Package::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('package', Adminetic\Website\Models\Admin\Package::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Projects',
                'icon' => 'fa fa-trophy',
                'is_active' => request()->routeIs('project*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Project::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Project::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('project', Adminetic\Website\Models\Admin\Project::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Facilities',
                'icon' => 'fa fa-star',
                'is_active' => request()->routeIs('facility*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Facility::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Facility::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('facility', Adminetic\Website\Models\Admin\Facility::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Clients',
                'icon' => 'fa fa-user-tie',
                'is_active' => request()->routeIs('client*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Client::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Client::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('client', Adminetic\Website\Models\Admin\Client::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Galleries',
                'icon' => 'fa fa-folder',
                'is_active' => request()->routeIs('gallery*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Gallery::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Gallery::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('gallery', Adminetic\Website\Models\Admin\Gallery::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Images',
                'icon' => 'fas fa-image',
                'is_active' => request()->routeIs('image*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Image::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Image::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('image', Adminetic\Website\Models\Admin\Image::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Videos',
                'icon' => 'fab fa-youtube',
                'is_active' => request()->routeIs('video*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Video::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Video::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('video', Adminetic\Website\Models\Admin\Video::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Page',
                'icon' => 'fas fa-file',
                'is_active' => request()->routeIs('page*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Page::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Page::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('page', Adminetic\Website\Models\Admin\Page::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Event',
                'icon' => 'fas fa-calendar',
                'is_active' => request()->routeIs('event*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Event::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Event::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('event', Adminetic\Website\Models\Admin\Event::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Post',
                'icon' => 'fas fa-camera',
                'is_active' => request()->routeIs('post*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Post::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Post::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('post', Adminetic\Website\Models\Admin\Post::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Template',
                'icon' => 'fas fa-paw',
                'is_active' => request()->routeIs('template*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Template::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Template::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('template', Adminetic\Website\Models\Admin\Template::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Block',
                'icon' => 'fas fa-square',
                'is_active' => request()->routeIs('block*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Block::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Block::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('block', Adminetic\Website\Models\Admin\Block::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Testimonial',
                'icon' => 'fas fa-star',
                'is_active' => request()->routeIs('testimonial*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Website\Models\Admin\Testimonial::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Website\Models\Admin\Testimonial::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('testimonial', Adminetic\Website\Models\Admin\Testimonial::class),
            ],
        ];
    }
}
