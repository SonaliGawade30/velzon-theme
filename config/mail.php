<?php

return [

    

    'default' => env('MAIL_MAILER', 'smtp'),

   
    'mailers' => [
         'smtp' => [
             'transport' => 'smtp',
             'host' => env('MAIL_HOST', 'smtp.mailtrap.io'),
             'port' => env('MAIL_PORT', 2525),
             'encryption' => env('MAIL_ENCRYPTION', 'tls'),
             'username' => env('MAIL_USERNAME'),
             'password' => env('MAIL_PASSWORD'),
             'timeout' => null,
             'auth_mode'  => null,
             'verify_peer'       => false,
         ],

        'ses' => [
            'transport' => 'ses',
        ],

        'postmark' => [
            'transport' => 'postmark',
            // 'message_stream_id' => null,
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'mailgun' => [
            'transport' => 'mailgun',
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
        ],

        
        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
        ],
    ],

    

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'no-reply@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

   

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];