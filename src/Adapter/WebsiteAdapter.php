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
            ], [
                'type' => 'menu',
                'name' => 'About',
                'icon' => 'fab fa-bandcamp',
                'is_active' => request()->routeIs('about*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\About::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\About::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('about', \Adminetic\Website\Models\Admin\About::class),

            ], [
                'type' => 'menu',
                'name' => 'History',
                'icon' => 'fa fa-history',
                'is_active' => request()->routeIs('history*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\History::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\History::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('history', \Adminetic\Website\Models\Admin\History::class),

            ],
            [
                'type' => 'menu',
                'name' => 'Slider',
                'icon' => 'fa fa-sliders-h',
                'is_active' => request()->routeIs('slider*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Slider::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Slider::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('slider', \Adminetic\Website\Models\Admin\Slider::class),

            ],
            [
                'type' => 'menu',
                'name' => 'Project',
                'icon' => 'fa fa-spa',
                'is_active' => request()->routeIs('project*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Project::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Project::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('project', \Adminetic\Website\Models\Admin\Project::class),

            ], [
                'type' => 'menu',
                'name' => 'Package',
                'icon' => 'fa fa-gift',
                'is_active' => request()->routeIs('package*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Package::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Package::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('package', \Adminetic\Website\Models\Admin\Package::class),

            ], [
                'type' => 'menu',
                'name' => 'Team',
                'icon' => 'fa fa-users',
                'is_active' => request()->routeIs('team*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Team::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Team::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('team', \Adminetic\Website\Models\Admin\Team::class),

            ], [
                'type' => 'menu',
                'name' => 'Testimonial',
                'icon' => 'fa fa-user-check',
                'is_active' => request()->routeIs('testimonial*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Testimonial::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Testimonial::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('testimonial', \Adminetic\Website\Models\Admin\Testimonial::class),

            ], [
                'type' => 'menu',
                'name' => 'Page',
                'icon' => 'far fa-file',
                'is_active' => request()->routeIs('page*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Page::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Page::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('page', \Adminetic\Website\Models\Admin\Page::class),
            ], [
                'type' => 'menu',
                'name' => 'Download',
                'icon' => 'fa fa-cloud-download-alt',
                'is_active' => request()->routeIs('download*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Download::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Download::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('download', \Adminetic\Website\Models\Admin\Download::class),

            ],
            [
                'type' => 'menu',
                'name' => 'Process',
                'icon' => 'fab fa-react',
                'is_active' => request()->routeIs('process*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Process::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Process::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('process', \Adminetic\Website\Models\Admin\Process::class),

            ],
            [
                'type' => 'menu',
                'name' => 'Career',
                'icon' => 'fa fa-user-md',
                'is_active' => request()->routeIs('career*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Career::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Career::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('career', \Adminetic\Website\Models\Admin\Career::class),

            ], [
                'type' => 'menu',
                'name' => 'Popup',
                'icon' => 'fab fa-cloudsmith',
                'is_active' => request()->routeIs('popup*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Popup::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Popup::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('popup', \Adminetic\Website\Models\Admin\Popup::class),

            ], [
                'type' => 'menu',
                'name' => 'Notice',
                'icon' => 'far fa-bell',
                'is_active' => request()->routeIs('notice*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Notice::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Notice::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('notice', \Adminetic\Website\Models\Admin\Notice::class),

            ], [
                'type' => 'menu',
                'name' => 'Client',
                'icon' => 'fa fa-user-tie',
                'is_active' => request()->routeIs('client*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Client::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Client::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('client', \Adminetic\Website\Models\Admin\Client::class),

            ], [
                'type' => 'menu',
                'name' => 'Gallery',
                'icon' => 'fa fa-file-image',
                'is_active' => request()->routeIs('gallery*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Gallery::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Gallery::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('gallery', \Adminetic\Website\Models\Admin\Gallery::class),

            ], [
                'type' => 'menu',
                'name' => 'Counter',
                'icon' => 'fa fa-clock',
                'is_active' => request()->routeIs('counter*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Counter::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Counter::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('counter', \Adminetic\Website\Models\Admin\Counter::class),

            ], [
                'type' => 'menu',
                'name' => 'Faq',
                'icon' => 'fa fa-question',
                'is_active' => request()->routeIs('faq*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Faq::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Faq::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('faq', \Adminetic\Website\Models\Admin\Faq::class),

            ], [
                'type' => 'menu',
                'name' => 'Feature',
                'icon' => 'fa fa-star',
                'is_active' => request()->routeIs('feature*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Feature::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Feature::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('feature', \Adminetic\Website\Models\Admin\Feature::class),

            ], [
                'type' => 'menu',
                'name' => 'Facility',
                'icon' => 'fa fa-seedling',
                'is_active' => request()->routeIs('facility*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Facility::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Facility::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('facility', \Adminetic\Website\Models\Admin\Facility::class),

            ], [
                'type' => 'menu',
                'name' => 'Service',
                'icon' => 'fa fa-hard-hat',
                'is_active' => request()->routeIs('service*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Service::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Service::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('service', \Adminetic\Website\Models\Admin\Service::class),

            ], [
                'type' => 'menu',
                'name' => 'Category',
                'icon' => 'fa fa-code-branch',
                'is_active' => request()->routeIs('category*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Category::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Category::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('category', \Adminetic\Website\Models\Admin\Category::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Post',
                'icon' => 'fa fa-blog',
                'is_active' => request()->routeIs('post*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Post::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Post::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('post', \Adminetic\Website\Models\Admin\Post::class),
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
                'name' => 'E-commerce',
                'description' => 'Modules',
            ],
            [
                'type' => 'menu',
                'name' => 'Payment',
                'icon' => 'fa fa-money-bill',
                'is_active' => request()->routeIs('payment*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Payment::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Payment::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('payment', \Adminetic\Website\Models\Admin\Payment::class),

            ],
            [
                'type' => 'menu',
                'name' => 'Product',
                'icon' => 'fab fa-product-hunt',
                'is_active' => request()->routeIs('product*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Product::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Product::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('product', \Adminetic\Website\Models\Admin\Product::class),

            ],
            [
                'type' => 'menu',
                'name' => 'Software',
                'icon' => 'fa fa-laptop',
                'is_active' => request()->routeIs('software*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Software::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Software::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('software', \Adminetic\Website\Models\Admin\Software::class),
            ], [
                'type' => 'menu',
                'name' => 'Attribute',
                'icon' => 'fab fa-scribd',
                'is_active' => request()->routeIs('attribute*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', \Adminetic\Website\Models\Admin\Attribute::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', \Adminetic\Website\Models\Admin\Attribute::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('attribute', \Adminetic\Website\Models\Admin\Attribute::class),
            ],
        ];
    }
}
