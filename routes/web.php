<?php

use Src\Route;

Route::add('GET', '/employees', [Controller\Site::class, 'employees'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);