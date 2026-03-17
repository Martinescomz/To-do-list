<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
//Route GET (retun information) main route
Route::get('/', [TaskController::class, 'index']);

//Route POST (create information) route for create tasks 
Route::post('/task', [TaskController::class, 'store']);

//Route PUT (edit information) route for edit tasks
Route::put('/task/update/{id}', [TaskController::class, 'update']);

//Route DELETE (delete information) route for delete tasks
Route::delete('/task/{id}', [TaskController::class, 'destroy']);



