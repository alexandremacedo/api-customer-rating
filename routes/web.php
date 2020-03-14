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

$router->get('/', function() use ($router){

    return 'api-customer-rating';

});

$router->get("/clients", "ClientsController@getAll");

$router->group(['prefix' => "/client"], function() use ($router){
    $router->get("/{id}", "ClientsController@get");
    $router->post("/", "ClientsController@store");
    $router->put("/{id}", "ClientsController@update");
    $router->delete("/{id}", "ProductsController@disable");
    $router->delete("/{id}", "ClientsController@destroy");
});


$router->get("/products", "ProductsController@getAll");

$router->group(['prefix' => "/product"], function() use ($router){
    $router->get("/{id}", "ProductsController@get");
    $router->post("/", "ProductsController@store");
    $router->put("/{id}", "ProductsController@update");
    $router->delete("/{id}", "ProductsController@disable");
    $router->delete("/{id}", "ProductsController@destroy");
});

$router->get("/stores", "StoresController@getAll");

$router->group(['prefix' => "/store"], function() use ($router){

    $router->get("/{id}", "StoresController@get");
    $router->post("/", "StoresController@store");
    $router->put("/{id}", "StoresController@update");
    $router->delete("/{id}", "StoresController@disable");
    $router->delete("/{id}", "StoresController@destroy");

});

$router->get("/contributors", "ContributorsController@getAll");

$router->group(['prefix' => "/contributor"], function() use ($router){

    $router->get("/{id}", "ContributorsController@get");
    $router->post("/", "ContributorsController@store");
    $router->put("/{id}", "ContributorsController@update");
    $router->delete("/{id}", "ContributorsController@disable");
    $router->delete("/{id}", "ContributorsController@destroy");

});

$router->group(['prefix' => "/transaction"], function() use ($router){

    $router->post("/", "TransactionsController@store");
    $router->put("/{id}", "TransactionsController@update");

});

$router->get("/ratings", "RatingsController@getAll");

$router->group(['prefix' => "/rating"], function() use ($router){

    $router->get("/{id}", "RatingsController@get");
    $router->post("/", "RatingsController@store");

});


