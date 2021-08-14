<?php

return [
    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.mailtrap.io'),
    'port' => env('MAIL_PORT', 2525),
    'from' => ['address' => 'bbkgoreng72@gmail.com', 'name' => 'no-reply@exl'],
    'encryption' => 'ssl',
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,

    'stream' => [
        'ssl' => [
            'allow_self_signed' => true,
            'verify_peer'       => false,
            'verify_peer_name'  => false,
        ],
    ],
];