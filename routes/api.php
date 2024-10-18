<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FolderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1/')->group(function () {
    Route::get('/folders/tree', [FolderController::class, 'getFolderTree']);
    Route::get('/folders/{id}/contents', [FolderController::class, 'getFolderContents']);
    Route::get('/folders/{id}/breadcrumb', [FolderController::class, 'getBreadcrumbPath']);
    Route::post('/folders', [FolderController::class, 'createFolder']);
    Route::post('/files', [FolderController::class, 'createFile']);
});
