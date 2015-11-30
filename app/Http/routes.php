<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Task;
use App\User;

Route::get('/', function () {

    $tasks = DB::table('tasks')
            ->leftJoin('users', 'tasks.user_id', '=', 'users.user_id')
            ->get();

    $users = User::all();

    return View::make('tasks', compact('tasks', 'users'));
});

Route::get('/user/{id}', function ($id) {

    if($id != 0) {
      $tasks = DB::table('tasks')
              ->leftJoin('users', 'tasks.user_id', '=', 'users.user_id')
              ->where('users.user_id', $id)
              ->get();
    } else {
      $tasks = DB::table('tasks')
              ->leftJoin('users', 'tasks.user_id', '=', 'users.user_id')
              ->get();
    }

    return Response::json($tasks);

});
