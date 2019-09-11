<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get("/api/clients", "ClientsController@getAll");

$router->group(['prefix' => "/api/client"], function() use ($router){

    $router->get("/{id}", "ClientsController@get");
    $router->post("/", "ClientsController@store");
    $router->put("/{id}", "ClientsController@update");
    $router->delete("/{id}", "ProductsController@disable");
    $router->delete("/{id}", "ClientsController@destroy");

});


$router->get("/api/products", "ProductsController@getAll");

$router->group(['prefix' => "/api/product"], function() use ($router){

    $router->get("/{id}", "ProductsController@get");
    $router->post("/", "ProductsController@store");
    $router->put("/{id}", "ProductsController@update");
    $router->delete("/{id}", "ProductsController@disable");
    $router->delete("/{id}", "ProductsController@destroy");

});

$router->get("/api/stores", "StoresController@getAll");

$router->group(['prefix' => "/api/store"], function() use ($router){

    $router->get("/{id}", "StoresController@get");
    $router->post("/", "StoresController@store");
    $router->put("/{id}", "StoresController@update");
    $router->delete("/{id}", "StoresController@disable");
    $router->delete("/{id}", "StoresController@destroy");

});

$router->get("/api/contributors", "ContributorsController@getAll");

$router->group(['prefix' => "/api/contributor"], function() use ($router){

    $router->get("/{id}", "ContributorsController@get");
    $router->post("/", "ContributorsController@store");
    $router->put("/{id}", "ContributorsController@update");
    $router->delete("/{id}", "ContributorsController@disable");
    $router->delete("/{id}", "ContributorsController@destroy");

});

$router->get("/api/acquisitions", "AcquisitionsController@getAll");

$router->group(['prefix' => "/api/acquisition"], function() use ($router){

    $router->get("/{id}", "AcquisitionsController@get");
    $router->post("/", "AcquisitionsController@store");
    $router->put("/{id}", "AcquisitionsController@update");
    $router->delete("/{id}", "AcquisitionsController@disable");
    $router->delete("/{id}", "AcquisitionsController@destroy");

});

$router->get("/api/ratings", "RatingsController@getAll");

$router->group(['prefix' => "/api/rating"], function() use ($router){

    $router->get("/{id}", "RatingsController@get");
    $router->post("/", "RatingsController@store");
    $router->put("/{id}", "RatingsController@update");
    $router->delete("/{id}", "RatingsController@disable");
    $router->delete("/{id}", "RatingsController@destroy");

});


