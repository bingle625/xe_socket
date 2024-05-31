<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Hsj\XePlugin\ChatPlugin\Controllers'
], static function () {
    Route::group(
            ['prefix' => 'chat-plugin', 'middleware' => 'auth'],
            static function () {
                Route::get('/', [
                    'as' => 'chat-plugin::index','uses' => 'Controller@index'
                ]);
                Route::post('/message',[
                    'as' => 'chat-plugin::send-message',
                    'uses' => 'Controller@sendMessage'
                ]);

                Route::get('/check',[
                    'as' => 'chat-plugin::check',
                    'uses' => 'Controller@checkSoketiStatus'
                ]);
            }
        );
});