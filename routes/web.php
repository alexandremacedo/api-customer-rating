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

$router->group(['prefix' => "/clients"], function() use ($router){
    $router->get("/", "ClientsController@getAll");
    $router->get("/{id}", "ClientsController@get");
    $router->post("/", "ClientsController@store");
    $router->put("/{id}", "ClientsController@update");
    $router->delete("/{id}", "ProductsController@disable");
    $router->delete("/{id}", "ClientsController@destroy");
});

$router->group(['prefix' => "/products"], function() use ($router){
    $router->get("/", "ProductsController@getAll");
    $router->get("/{id}", "ProductsController@get");
    $router->post("/", "ProductsController@store");
    $router->put("/{id}", "ProductsController@update");
    $router->delete("/{id}", "ProductsController@disable");
    $router->delete("/{id}", "ProductsController@destroy");
});

$router->group(['prefix' => "/stores"], function() use ($router){
    $router->get("/", "StoresController@getAll");
    $router->get("/{id}", "StoresController@get");
    $router->post("/", "StoresController@store");
    $router->put("/{id}", "StoresController@update");
    $router->delete("/{id}", "StoresController@disable");
    $router->delete("/{id}", "StoresController@destroy");
});

$router->group(['prefix' => "/contributors"], function() use ($router){
    $router->get("/", "ContributorsController@getAll");
    $router->get("/{id}", "ContributorsController@get");
    $router->post("/", "ContributorsController@store");
    $router->put("/{id}", "ContributorsController@update");
    $router->delete("/{id}", "ContributorsController@disable");
    $router->delete("/{id}", "ContributorsController@destroy");

});

$router->group(['prefix' => "/transactions"], function() use ($router){
    $router->get("/", "TransactionsController@getAll");
    $router->post("/", "TransactionsController@store");
    $router->get("/{id}", "TransactionsController@get");
    $router->put("/{id}", "TransactionsController@update");
});

$router->group(['prefix' => "/ratings"], function() use ($router){
    $router->get("/", "RatingsController@getAll");
    $router->get("/{id}", "RatingsController@get");
    $router->post("/", "RatingsController@store");
});
