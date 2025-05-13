<?php

use Src\Route;

Route::add(['GET','POST'], '/employees', [Controller\EmployeeController::class, 'employees'])->middleware('auth');
Route::add(['GET','POST'], '/employees/add', [Controller\EmployeeController::class, 'addEmployee'])->middleware('auth');
Route::add('GET','/employees/average-age', [Controller\EmployeeController::class, 'averageAgeByUnit'])->middleware('auth');
Route::add(['GET','POST'], '/units', [Controller\UnitController::class, 'units'])->middleware('auth');
Route::add(['GET','POST'], '/units/add', [Controller\UnitController::class, 'addUnit'])->middleware('auth');
Route::add(['GET','POST'], '/users', [Controller\UserController::class, 'users'])->middleware('auth');
Route::add(['GET','POST'], '/users/add', [Controller\UserController::class, 'addUser'])->middleware('auth');
Route::add(['GET', 'POST'], '/login', [Controller\AuthController::class, 'login'])->middleware('antiauth');
Route::add('GET', '/logout', [Controller\AuthController::class, 'logout']);
