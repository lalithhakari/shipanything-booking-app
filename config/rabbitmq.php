<?php

return [
    'host' => env('RABBITMQ_HOST', 'booking-rabbitmq'),
    'port' => env('RABBITMQ_PORT', 5672),
    'user' => env('RABBITMQ_USER', 'booking_user'),
    'password' => env('RABBITMQ_PASSWORD', 'booking_password'),
];
