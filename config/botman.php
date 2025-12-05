<?php

return [

    /*
    |--------------------------------------------------------------------------
    | BotMan Conversation Cache Time
    |--------------------------------------------------------------------------
    |
    | The amount of minutes the conversation data will be cached for.
    |
    */
    'conversation_cache_time' => 40,

    /*
    |--------------------------------------------------------------------------
    | BotMan User Cache Time
    |--------------------------------------------------------------------------
    |
    | The amount of minutes the user data will be cached for.
    |
    */
    'user_cache_time' => 30,

    /*
    |--------------------------------------------------------------------------
    | BotMan Web Driver Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for the Web driver. This will be used when you don't 
    | specify a driver and is the default driver for BotMan.
    |
    */
    'web' => [
        'matchingData' => [
            'driver' => 'web',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | BotMan Storage Driver
    |--------------------------------------------------------------------------
    |
    | The driver that should be used to store conversation state data.
    |
    */
    'storage_driver' => \BotMan\BotMan\Drivers\DriverManager::class,

];
