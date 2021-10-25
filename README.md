# Website Module for Adminetic Admin Panel

![Adminetic Website Module](https://github.com/pratiksh404/adminetic-website/blob/main/screenshots/banner.png)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/adminetic/website.svg?style=flat-square)](https://packagist.org/packages/adminetic/website)

[![Stars](https://img.shields.io/github/stars/pratiksh404/adminetic-website)](https://github.com/pratiksh404/adminetic-website/stargazers) [![Downloads](https://img.shields.io/packagist/dt/adminetic/website.svg?style=flat-square)](https://packagist.org/packages/adminetic/website) [![StyleCI](https://github.styleci.io/repos/385822775/shield?branch=main)](https://github.styleci.io/repos/385822775?branch=main) [![Build Status](https://scrutinizer-ci.com/g/pratiksh404/adminetic-website/badges/build.png?b=main)](https://scrutinizer-ci.com/g/pratiksh404/adminetic-website/build-status/main) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pratiksh404/adminetic-website/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/pratiksh404/adminetic-website/?branch=main) [![CodeFactor](https://www.codefactor.io/repository/github/pratiksh404/adminetic-website/badge)](https://www.codefactor.io/repository/github/pratiksh404/adminetic-website) [![License](https://img.shields.io/github/license/pratiksh404/adminetic-website)](//packagist.org/packages/adminetic/website)

Website module for Adminetic Admin Panel

For detailed documentaion visit [Adminetic Website Module Documentation](https://app.gitbook.com/@pratikdai404/s/adminetic/addons/website)

#### Contains : -

- Service Module
- Facility Module
- Counter Module
- Team Module
- FAQ Module
- Package Module
- Project Module
- Client Module
- Gallery Module
- Image Module
- Video Module
- Page Module
- Category Module

## Installation

You can install the package via composer:

```bash
composer require adminetic/website
```

Then

```bash
php artisan install:adminetic-website
```

## Include Adminetic Website Adapter

In config/adminetic.php, include

```
    // Adapters
    'adapters' => [
        Adminetic\Website\Adapter\WebsiteAdapter::class,
    ],
```

## Note

```
php artisan install:adminetic-category // To install category module only
php artisan adminetic:website-permission // To seed website module permission only
```

## Dashboard

Include adminetic website dashboard view component to `view/admin/dashboard/index`

```
<div class="container-fluid">
    <x-adminetic-website-analytics-dashboard />  <!-- Website Dashboard Component -->
</div>
```

You can enable/disable dashboard components from config/website file

```
'google_analytics_dashboard_active' => false,
'model_count_dashboard_active' => true,
'post_dashboard_active' => false,
```

Add view id in env

```
ANALYTICS_VIEW_ID=
```

Add apex chart asset in config/adminetic.php

```
    'assets' => [
        [
            'name' => 'Charts',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'active' => true,
                    'location' => 'adminetic/assets/js/chart/apex-chart/apex-chart.js',
                ],
                [
                    'type' => 'js',
                    'active' => true,
                    'location' => 'adminetic/assets/js/datepicker/daterange-picker/daterangepicker.js',
                ],
            ],
        ],
    ],
```

For google analytics component. Please follow the documentaion [spatie/laravel-analytics](https://github.com/spatie/laravel-analytics)

## Todo

- [ ] Frontend theme support
- [x] Google Analytic Dashboard
- [ ] Ready made themes

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email pratikdai404@gmail.com instead of using the issue tracker.

## Credits

- [Pratik Shrestha](https://github.com/adminetic)
- [spatie/laravel-analytics](https://github.com/spatie/laravel-analytics)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Screenshots

![Adminetic Announcemment Module](https://github.com/pratiksh404/adminetic-website/blob/main/screenshots/dashboard.jpeg)
![Adminetic Announcemment Module](https://github.com/pratiksh404/adminetic-website/blob/main/screenshots/google-analytic-adminetic-website.jpeg)
![Adminetic Announcemment Module](https://github.com/pratiksh404/adminetic-website/blob/main/screenshots/category.jpg)
![Adminetic Announcemment Module](https://github.com/pratiksh404/adminetic-website/blob/main/screenshots/gallery.jpg)
![Adminetic Announcemment Module](https://github.com/pratiksh404/adminetic-website/blob/main/screenshots/package.jpg)
![Adminetic Announcemment Module](https://github.com/pratiksh404/adminetic-website/blob/main/screenshots/page.jpg)
![Adminetic Announcemment Module](https://github.com/pratiksh404/adminetic-website/blob/main/screenshots/service.jpg)
![Adminetic Announcemment Module](https://github.com/pratiksh404/adminetic-website/blob/main/screenshots/team.jpg)
