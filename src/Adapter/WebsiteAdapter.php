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
                'name' => 'Charts',
                'active' => true,
                'files' => [
                    [
                        'type' => 'js',
                        'active' => true,
                        'location' => 'adminetic/assets/js/chart/apex-chart/apex-chart.js',
                    ],
                ],
            ],
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
                'name' => 'Media Library',
                'active' => true,
                'files' => [
                    [
                        'type' => 'css',
                        'active' => true,
                        'location' => 'plugins/website/medialibrarypro/styles.css',
                    ],
                ],
            ],
            [
                'name' => 'Photo Swipe',
                'active' => false,
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
        return [
            [
                'type' => 'breaker',
                'name' => 'Website',
                'description' => 'CMS',
            ],
            [
                'type' => 'menu',
                'name' => 'Project',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('project*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Project::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Project::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('project', \App\Models\Admin\Project::class),

            ], [
                'type' => 'menu',
                'name' => 'Package',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('package*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Package::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Package::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('package', \App\Models\Admin\Package::class),

            ], [
                'type' => 'menu',
                'name' => 'Team',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('team*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Team::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Team::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('team', \App\Models\Admin\Team::class),

            ], [
                'type' => 'menu',
                'name' => 'Testimonial',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('testimonial*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Testimonial::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Testimonial::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('testimonial', \App\Models\Admin\Testimonial::class),

            ], [
                'type' => 'menu',
                'name' => 'Page',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('page*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Page::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Page::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('page', \App\Models\Admin\Page::class),
            ], [
                'type' => 'menu',
                'name' => 'Download',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('download*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Download::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Download::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('download', \App\Models\Admin\Download::class),

            ],
            [
                'type' => 'menu',
                'name' => 'Process',
                'icon' => 'fa fa-network-wired',
                'is_active' => request()->routeIs('process*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Process::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Process::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('process', \App\Models\Admin\Process::class),

            ],
            [
                'type' => 'menu',
                'name' => 'Career',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('career*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Career::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Career::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('career', \App\Models\Admin\Career::class),

            ], [
                'type' => 'menu',
                'name' => 'Popup',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('popup*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Popup::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Popup::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('popup', \App\Models\Admin\Popup::class),

            ], [
                'type' => 'menu',
                'name' => 'Notice',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('notice*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Notice::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Notice::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('notice', \App\Models\Admin\Notice::class),

            ], [
                'type' => 'menu',
                'name' => 'Client',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('client*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Client::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Client::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('client', \App\Models\Admin\Client::class),

            ], [
                'type' => 'menu',
                'name' => 'Gallery',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('gallery*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Gallery::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Gallery::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('gallery', \App\Models\Admin\Gallery::class),

            ], [
                'type' => 'menu',
                'name' => 'Counter',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('counter*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Counter::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Counter::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('counter', \App\Models\Admin\Counter::class),

            ], [
                'type' => 'menu',
                'name' => 'Faq',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('faq*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Faq::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Faq::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('faq', \App\Models\Admin\Faq::class),

            ], [
                'type' => 'menu',
                'name' => 'Feature',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('feature*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Feature::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Feature::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('feature', \App\Models\Admin\Feature::class),

            ], [
                'type' => 'menu',
                'name' => 'Facility',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('facility*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Facility::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Facility::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('facility', \App\Models\Admin\Facility::class),

            ], [
                'type' => 'menu',
                'name' => 'Service',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('service*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Service::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Service::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('service', \App\Models\Admin\Service::class),

            ], [
                'type' => 'menu',
                'name' => 'Category',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('category*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Category::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Category::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('category', \App\Models\Admin\Category::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Post',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('post*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Post::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Post::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('post', \App\Models\Admin\Post::class),
            ],
            [
                'type' => 'link',
                'name' => 'Visitor Messages',
                'icon' => 'fa fa-comment',
                'link' => route('visitorMessage'),
            ],
            [
                'type' => 'link',
                'name' => 'Visitor Inquiry',
                'icon' => 'fa fa-comment',
                'link' => route('visitorInquiry'),
            ],
            [
                'type' => 'breaker',
                'name' => 'Finance',
                'description' => 'Modules',
            ],
            [
                'type' => 'breaker',
                'name' => 'E-commerce',
                'description' => 'Modules',
            ],
            [
                'type' => 'menu',
                'name' => 'Payment',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('payment*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Payment::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Payment::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('payment', \App\Models\Admin\Payment::class),

            ],
            [
                'type' => 'menu',
                'name' => 'Product',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('product*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Product::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Product::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('product', \App\Models\Admin\Product::class),

            ],
            [
                'type' => 'menu',
                'name' => 'Software',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('software*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Software::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Software::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('software', \App\Models\Admin\Software::class),
            ], [
                'type' => 'menu',
                'name' => 'Attribute',
                'icon' => 'fa fa-wrench',
                'is_active' => request()->routeIs('attribute*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \App\Models\Admin\Attribute::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \App\Models\Admin\Attribute::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('attribute', \App\Models\Admin\Attribute::class),

            ],
        ];
    }
}
