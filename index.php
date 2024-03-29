<?php

require_once("Resources/Router.php");
require_once("Resources/Controller.php");
require_once("Resources/Connection.php");
require_once("Resources/Model.php");
require_once("Resources/Query.php");

$route = new Router();


// GET /users - Obtener usuarios
$route->get('api/users', 'UserController@users');
$route->get('api/user/{id}', 'UserController@show');
$route->post('api/user', 'UserController@create');
$route->patch('api/user/{id}', 'UserController@update');
$route->delete('api/user/{id}', 'UserController@delete');

// GET /Comments - Obtener Comentarios
$route->get('api/comments', 'CommentController@comments');
$route->get('api/comment/{id}', 'CommentController@show');
$route->post('api/comment', 'CommentController@create');
$route->patch('api/comment/{id}', 'CommentController@update');
$route->delete('api/comment/{id}', 'CommentController@delete');
$route->patch('api/comment/likes', 'CommentController@addLike');


$route->get('', 'HomeController@index');
$route->get('index', 'HomeController@index');
$route->get('logout', 'LoginController@logout');


$route->get('login', 'LoginController@index');
$route->get('register', 'LoginController@create');
$route->post('login', 'LoginController@login');

$route->dispatch();
