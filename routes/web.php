<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', 'Api\Auth\AuthController@login');

/**
 * 前后端分离，使用web session中间件时，前端post/put/delete/patch
 * 都会校验CSRF-TOKEN
 *
 * $encrypter = app('Illuminate\Encryption\Encrypter');   // 调用csrf中间件加密方法
 * $encrypted_token = $encrypter->encrypt(csrf_token());  // 对csrf token 加密
 *
 * (直接返回给客户端，或者直接设置到客户端的cookie中)
 *
 * 前端 header X-CSRF-TOKEN: xxxxxxx
 *
 */
