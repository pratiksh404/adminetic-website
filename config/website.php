<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Setting
    |--------------------------------------------------------------------------
    |
    */
    'google_analytics_dashboard_active' => false,
    'model_count_dashboard_active' => true,
    'post_dashboard_active' => false,
    'publish_migrations' => true,
    'migration_publish_path' => 'database/migrations/website',

    /*
    |--------------------------------------------------------------------------
    | Post Type
    |--------------------------------------------------------------------------
    |
    */
    'post_type' => [
        [
            'id' => 1,
            'name' => 'General Post',
        ],
        [
            'id' => 2,
            'name' => 'Video Post',
        ],
        [
            'id' => 3,
            'name' => 'Audio Post',
        ],
    ],

    /*
       * Models to be discovered by category module.
       */
    'models' => [
        'Facility',
        'Feature',
        'Post',
    ],

    /*
    |--------------------------------------------------------------------------
    | Block Group Theme
    |--------------------------------------------------------------------------
    |
    */
    'block_group_themes' => [1],

    /*
    |--------------------------------------------------------------------------
    | API Configurations
    |--------------------------------------------------------------------------
    |
    */
    'website_api_end_points' => true,
    'website_restful_api_end_points' => true,
    'website_client_api_end_points' => true,
    'website_api_prefix' => 'api',
    'rest_api_prefix' => 'rest',
    'client_api_prefix' => 'client',
];
