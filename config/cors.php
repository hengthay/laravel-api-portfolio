<?php 

// To allow cors for access to our site.
return [
  'paths' => ['api/*', 'sanctum/csrf-cookie', 'storage/*'],

  'allowed_methods' => ['*'],

  'allowed_origins' => [
    'http://localhost:5173', 
    'http://127.0.0.1:5173', 
    'http://localhost:5174', 
    'http://127.0.0.1:5174'
  ],

  'allowed_origins_patterns' => [],

  'allowed_headers' => ['*'],
  
  'exposed_headers' => [],

  'max_age' => 0,

  'supports_credentials' => true
];