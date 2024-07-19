<?php

require_once __DIR__.'/utils/utils.php';
require_once __DIR__.'/router.php';

// Home Routes
get('/', 'frontend/pages/index.html');
post('/', 'frontend/pages/index.html');

// Authentication Routes
get('/login', 'frontend/pages/login.html'); // GET
get('/signup', 'frontend/pages/signup.html'); // GET
post('/signup', 'frontend/pages/signup.html'); // POST

// Frontend Pages Routes
get('/hello-world', 'frontend/pages/hello-world.html'); // GET
get('/random-image', 'frontend/pages/random-image.html'); // GET

// Admin Route
get('/admin', function() {
    if (isAdmin()) {
        include_once __DIR__ . '/frontend/pages/admin.html';
    } else {
        // Redirect to 403 page
        include_once __DIR__ . "/frontend/pages/403.html";
    }
}); // GET

// API Routes
post('/api/hello-world/$langue', 'api/hello-world.php'); // POST
get('/api/hello-world/$langue', 'api/hello-world.php'); // GET
get('/api/random-image', 'api/random-image.php'); // GET

// 404 Route
any('/404', 'frontend/pages/404.html');
// 403
any('/404', 'frontend/pages/403.html');
