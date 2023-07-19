<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require __DIR__ . '/vendor/autoload.php';

use app\config\Router;
use app\controllers\MainController;
use app\controllers\AuthController;
use app\controllers\DashboardController;

;


// auth
Router::post('/login/validate', function () {
 (new AuthController())->loginValidate();

});


Router::get('/login', function () {
 (new MainController())->loginForm();

});


Router::get('/logout', function () {
 (new AuthController())->logout();

});

# komentar in artikel
Router::post('/dashboard/artikel/(\d+)/komentar', function ($request) {
 $artikelId = $request->params[0];

});

// get all comment in article
Router::get('/dashboard/artikel/(\d+)/komentar', function ($request) {
 $artikelId = $request->params[0];

});

Router::delete('/dashboard/komentar/(\d+)', function ($request) {
 $artikelId = $request->params[0];

});





// DASHBOARD

Router::get('/dashboard/komentar/delete', function () {
 (new DashboardController())->komentarDelete();

});

Router::get('/dashboard/komentar', function () {
 (new DashboardController())->komentar();

});
 
Router::post('/dashboard/artikel/create/validate', function () {
 (new DashboardController())->artikelValidate();

});

Router::get('/dashboard/artikel/create', function () {
 (new DashboardController())->createArtikel();
});


Router::get('/dashboard/artikel/delete', function () {
 (new DashboardController())->artikelDelete();

});


Router::get('/dashboard/artikel', function () {
 (new DashboardController())->artikel();
});


Router::get('/dashboard', function () {
 (new DashboardController())->index();

});

// detail artikel
Router::get('/artikel/(\d+)', function ($request) {
 $artikelId = $request->params[0];
 (new MainController())->detailArtikel($artikelId);

});

Router::post('/artikel/(\d+)/komentar/create/validate', function ($request) {
 $artikelId = $request->params[0];
 (new MainController())->komentarValidate($artikelId);

});

Router::delete('/artikel/(\d+)', function ($request) {
 $artikelId = $request->params[0];

});

// get all aricle
Router::get('/artikel', function () {
 (new MainController())->artikelPage();

});

// homepage
Router::get('/', function () {
 (new MainController())->index();

});