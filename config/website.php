<?php

return [

    /*
    |--------------------------------------------------------------------------
    | General Information
    |--------------------------------------------------------------------------
    | 
    */
    'phone' => '9843652012',
    'email' => 'info@doctypeinnovations.com,doctypeinnovation@gmail.com',
    'address' => 'Mid Baneshwor',
    'keywords' => '',
    'opening_hour' => '9am to 6pm',
    'facebook_messenger' => 'https://m.me/doctypenepal',
    /*
    |--------------------------------------------------------------------------
    | Setting
    |--------------------------------------------------------------------------
    |
    */
    'publish_migrations' => true,
    'migration_publish_path' => 'database/migrations/website',

    /*
    |--------------------------------------------------------------------------
    | Post Type
    |--------------------------------------------------------------------------
    |
    */
    'post_type' => [
        1 => 'News',
        2 => 'Research',
        3 => 'Radio Programs',
        4 => 'Publication',
        5 => 'Press Release',
    ],

    /*
    |--------------------------------------------------------------------------
    | Provinces
    |--------------------------------------------------------------------------
    */
    'provinces' => [
        1 => 'Province 1',
        2 => 'Province 2',
        3 => 'Province 3',
        4 => 'Province 4',
        5 => 'Province 5',
        6 => 'Province 6',
        7 => 'Province 7',
    ],

    /*
    |--------------------------------------------------------------------------
    | Report Type
    |--------------------------------------------------------------------------
    */
    'report_types' =>
    [
        1 => 'Annual Report',
        2 => 'Quarterly Report',
        3 => 'Compliance Report',
        4 => 'Right to Information',
        5 => 'AGM Minute Report',
    ],

    /*
    |--------------------------------------------------------------------------
    | Team Group Title
    |--------------------------------------------------------------------------
    */
    'team_group' => [
        1 => 'Executive Committee',
        2 => 'Senior Research Specialist Members',
        3 => 'Researchers',
        4 => 'Admin/Finance',
        5 => 'Associated Experts',
        6 => 'Alumni',
    ],

    /*
    |--------------------------------------------------------------------------
    | Client Group Title
    |--------------------------------------------------------------------------
    */
    'client_group' => [
        1 => 'Government Organizations',
        2 => 'International Organizations & Development Partners',
        3 => 'Academia',
        4 => 'NGO/INGO',
    ],

    /*
    |--------------------------------------------------------------------------
    | Career Group Title
    |--------------------------------------------------------------------------
    */
    'career_group' => [
        1 => 'Developer',
        2 => 'Designer',
        3 => 'Management',
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
