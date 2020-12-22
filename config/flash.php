<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Bootstrap
    |--------------------------------------------------------------------------
    |
    | Specifies bootstrap version (3, 4 or 5)
    */
    'bootstrapVersion' => 4,

    /*
    |--------------------------------------------------------------------------
    | Default message level
    |--------------------------------------------------------------------------
    |
    | Specifies default message level
    */
    'defaultLevel' => 'info',

    /*
    |--------------------------------------------------------------------------
    | Default validate message color
    |--------------------------------------------------------------------------
    |
    | Specifies default validation message background color
    */
    'validationBgColor' => '#ffd9cc',
    'validationBorderColor' => '#ffc6b3',

    /*
    |--------------------------------------------------------------------------
    | Default messages
    |--------------------------------------------------------------------------
    |
    | Default messages used for all available alert types
    */
    'messages' => [
        // Default success message
        'success' => 'Operation has been successfully completed',

        // Default warning message
        'warning' => 'Be careful, something was wrong!',

        // Default info message
        'info' => 'Please pay your attention!',

        // Default error message
        'error' => 'An error occurred while executing this operation',

        // Default danger message
        'danger' => 'An error occurred while executing this operation',

        // Default validation message
        'validation' => 'Validation had not been passed',
    ],

];