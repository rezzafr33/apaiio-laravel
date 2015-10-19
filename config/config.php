<?php

return [
    'AWS_API_KEY' => env('AWS_API_KEY', ''),
    'AWS_API_SECRET_KEY' => env('AWS_API_SECRET_KEY', ''),
    'AWS_ASSOCIATE_TAG' => env('AWS_ASSOCIATE_TAG', ''),
    'ENDPOINT' => env('AWS_ENDPOINT', 'com'),
    'REQUEST' => '\ApaiIO\Request\Rest\Request',
    'RESPONSE' => ''
];
