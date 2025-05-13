<?php

use Src\Route;

Route::add(['GET','POST'], '/employees', [Controller\EmployeeController::class, 'employees'])->middleware('auth');
Route::add(['GET','POST'], '/units', [Controller\UnitController::class, 'units'])->middleware('auth');
Route::add(['GET', 'POST'], '/login', [Controller\AuthController::class, 'login'])->middleware('antiauth');
Route::add('GET', '/logout', [Controller\AuthController::class, 'logout']);
Route::add('GET','/employees/average-age', [Controller\EmployeeController::class, 'averageAgeByUnit'])->middleware('auth');
Route::add('DELETE', '/employees/{id}', [Controller\EmployeeController::class, 'deleteEmployee'])->middleware('auth');