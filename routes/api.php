<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\NovelController;


// Route::get('/novels', [NovelController::class, 'index']);       
// Route::get('/novels/{id}', [NovelController::class, 'show']);   
// Route::post('/novels', [NovelController::class, 'store']);      
// Route::put('/novels/{id}', [NovelController::class, 'update']); 
// Route::delete('/novels/{id}', [NovelController::class, 'destroy']); 

Route::apiResource('novels', NovelController::class);