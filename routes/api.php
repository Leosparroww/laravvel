<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//GET
Route::get('user/list', [RouteController::class, 'userList']);
Route::get('product/list', [RouteController::class, 'productList']);
Route::get('category/list', [RouteController::class, 'categoryList']);

//POST
Route::post('create/category', [RouteController::class, 'createCategory']);
Route::post('create/contact', [RouteController::class, 'createContact']);

//delete data
Route::post('category/delete', [RouteController::class, 'deleteCategory']);

Route::get('category/details/{id}', [RouteController::class, 'categoryDetails']);

//update data

Route::post('category/update', [RouteController::class, 'categoryUpdate']);

/*
 *products list
 *http: //localhost:8000/api/product/list(GET)
 *
 * category list
 * http: //localhost:8000/api/category/list(GET)
 *
 *create category
 *http: //localhost:8000/api/create/category(POST)
 * body{
 *  'name' : ''
 * }
 *
 *  http: //localhost:8000/api/category/delete(POST)
 * body{
 *  id : '',
 * }
 *
 *  http: //localhost:8000/api/category/details/{id}(GET)
 *
 *  http: //localhost:8000/api/category/update(POST)
 *
 *  body{
 *   key => category_name , category_id,
 * }
 *
 *
 */
