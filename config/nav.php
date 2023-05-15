<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'admin' => [
//        'booking' => [
//            'name' =>  'Booking',
//            'actions' => [
//                'room_booking' => 'admin/room_booking',
//                'event_booking' =>  'admin/event_booking'
//            ],
//            'icon' => 'ti-control-forward'
//        ],
//        'event' => [
//            'name' => 'Event',
//            'actions' => [
//                'view' => 'admin/event',
//            ],
//            'icon' => 'ti-ticket'
//        ],
//        'food' => [
//            'name' => 'Food Menu',
//            'actions' => [
//                'view' => 'admin/food',
//            ],
//            'icon' => 'ti-pencil-alt'
//        ],
        'dashboard' => [
            'name' => 'Dashboard',
            'actions' => [
                'view' => 'admin/',
            ],
            'icon' => 'ti-home'
        ],
//        'colleges' => [
//            'name' => 'Colleges',
//            'actions' => [
//                'view' => 'admin/colleges',
//            ],
//            'icon' => 'ti-layout-grid2'
//        ],
//        'faq' => [
//            'name' => 'FAQs',
//            'actions' => [
//                'view' => 'admin/faqs',
//            ],
//            'icon' => 'ti-quote-right'
//        ],
        'user' => [
            'name' => 'User Management',
            'actions' => [
                'view' => 'admin/user',
            ],
            'icon' => 'ti-user'
        ],
    ],

];
