<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\TemplatesController;

Route::get('/', function ()
{
    return view('welcome');
});

Route::middleware('auth')->group(function ()
{
    Route::get('/documents/form', [DocumentsController::class, 'showForm'])->name('documents.form');
    Route::post('/documents/generate', [DocumentsController::class, 'generateWeb'])->name('documents.generate.web');
    Route::get('/documents/list', [DocumentsController::class, 'listWeb'])->name('documents.list.web');
    Route::get('/documents/download/{filename}', [DocumentsController::class, 'download'])->name('documents.download');

    Route::get('/templates', [TemplatesController::class, 'list'])->name('templates.list');
    Route::get('/templates/upload', [TemplatesController::class, 'form'])->name('templates.form');
    Route::post('/templates/upload', [TemplatesController::class, 'upload'])->name('templates.upload');
    Route::delete('/templates/{filename}', [TemplatesController::class, 'delete'])->name('templates.delete');
    Route::get('/templates/download/{filename}', [TemplatesController::class, 'download'])->name('templates.download');
});

Route::middleware('auth:sanctum')->prefix('api')->group(function ()
{
    Route::post('/documents/generate', [DocumentsController::class, 'generateApi'])->name('api.documents.generate');
    Route::get('/documents/list', [DocumentsController::class, 'listApi'])->name('api.documents.list');
});
