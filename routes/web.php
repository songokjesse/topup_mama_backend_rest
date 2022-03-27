<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(['prefix' => 'api/v1/'], function () use ($router) {
    //Book Routes
    $router->get('/books', ['as' => 'ShowBooks', 'uses' => 'BookController@index']);
    $router->get('/book/{id}', ['as' => 'showBook', 'uses' => 'BookController@show']);
    $router->get('/book/{id}/comments', ['as' => 'showBookComments', 'uses' => 'BookController@comments']);

    //Book Comment Route
    $router->get('comments',  ['uses' => 'CommentController@index']);
    $router->get('comment/{id}', ['uses' => 'CommentController@show']);
    $router->post('comments', ['uses' => 'CommentController@create']);
//    $router->delete('comments/{id}', ['uses' => 'CommentController@delete']);
//    $router->put('comments/{id}', ['uses' => 'CommentController@update']);

    //Character Route
    $router->get('characters',  ['uses' => 'CharacterController@index']);

});
