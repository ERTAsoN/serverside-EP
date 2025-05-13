<?php

use Src\Route;

Route::add(['GET','POST'], '/employees', [Controller\EmployeeController::class, 'employees'])->middleware('auth');
Route::add(['GET', 'POST'], '/login', [Controller\AuthController::class, 'login'])->middleware('antiauth');
Route::add('GET', '/logout', [Controller\AuthController::class, 'logout']);