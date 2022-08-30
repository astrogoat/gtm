<?php

return [
    /*
     * If you want to use some macro's you 'll probably store them
     * in a dedicated file. You can optionally define the path
     * to that file here and we will load it for you.
     */
    'macroPath' => env('GOOGLE_TAG_MANAGER_MACRO_PATH', ''),

    /*
     * The key under which data is saved to the session with flash.
     */
    'sessionKey' => env('GOOGLE_TAG_MANAGER_SESSION_KEY', '_googleTagManager'),

    /*
     * If you want to override the automatic injection of views
     * into some areas of your application so you to include
     * them yourself then you disable each in this array.
     */
    'include-frontend-views' => [
        'head' => true,
        'body' => true,
        'end' => true,
    ],
];
