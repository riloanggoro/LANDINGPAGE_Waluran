<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// HomePAge
$routes->add('/',          'Home::index');
$routes->add('/blog',      'Home::blogList');
$routes->add('/blog/baca', 'Home::blogDetail');

// Login & Logout
$routes->group("login", function ($routes) {

    // views
    $routes->add(
        '/', 
        'Login::index', 
        ['filter' => 'loggedIn']
    );

    // api
    $routes->get('show',      'Login::show');  
    $routes->post('create',   'Login::create');
    $routes->delete('delete', 'Login::delete');

});

// Dashboard
$routes->group("dashboard",['filter' => 'loggedIn'], function ($routes) {
    
    // views
    $routes->add('',                 'Dashboard::index');
    $routes->add('artikel',          'Dashboard::listArticle', ['filter' => 'pageForAdmin']);
    $routes->add('tambah-artikel',   'Dashboard::addArticle',  ['filter' => 'pageForAdmin']);
    $routes->add('edit-artikel',     'Dashboard::editArticle', ['filter' => 'pageForAdmin']);
    $routes->add('kategori-artikel', 'Dashboard::categoryArticle', ['filter' => 'pageForAdmin']);

});

// Users
$routes->group("user",['filter' => 'apiGuard'], function ($routes) {

    // Api
    $routes->get("profile", "Users::getProfile");
    $routes->put("profile", "Users::updateProfile");

});

// Articles Categories
$routes->group("kategori-artikel", function ($routes) {

    // Api
    $routes->get("",          "KategoriArtikel::show");
    $routes->post("",         "KategoriArtikel::create",['filter' => 'apiGuardAdmin']);
    $routes->put("",          "KategoriArtikel::update",['filter' => 'apiGuardAdmin']);
    $routes->delete("(:any)", "KategoriArtikel::delete/$1",['filter' => 'apiGuardAdmin']);

});

// Articles
$routes->group("artikel", function ($routes) {

    // Api
    $routes->get("",          "Artikel::show");
    $routes->get("related",   "Artikel::relatedArticle");
    $routes->post("",         "Artikel::create",['filter' => 'apiGuardAdmin']);
    $routes->put("",          "Artikel::update",['filter' => 'apiGuardAdmin']);
    $routes->delete("(:any)", "Artikel::delete/$1",['filter' => 'apiGuardAdmin']);

});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
