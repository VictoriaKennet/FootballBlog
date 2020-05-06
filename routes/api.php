<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('socials', 'InfoController@getSocials');
Route::post('social', 'InfoController@postSocial');
Route::post('social/{id}', 'InfoController@editSocial');
Route::delete('social/{id}', 'InfoController@deleteSocial');

Route::get('phones', 'InfoController@getPhones');
Route::post('phone', 'InfoController@postPhone');
Route::post('phone/{id}', 'InfoController@editPhone');
Route::delete('phone/{id}', 'InfoController@deletePhone');

Route::get('info', 'InfoController@getInfo');
Route::post('info', 'InfoController@editInfo');

Route::get('photos', 'GalleryController@getPhotos');
Route::post('photos', 'GalleryController@postPhotos');
Route::delete('photos/{id}', 'GalleryController@deletePhotos');

Route::get('videos', 'GalleryController@getVideos');
Route::post('videos', 'GalleryController@postVideos');
Route::delete('videos/{id}', 'GalleryController@deleteVideos');

Route::get('news', 'NewsController@get');
Route::get('news/{id}', 'NewsController@getId');
Route::post('news', 'NewsController@post');
Route::post('news/{id}', 'NewsController@edit');
Route::delete('news/{id}', 'NewsController@delete');

Route::get('applications', 'ApplicationsController@get');
Route::post('applications', 'ApplicationsController@post');
Route::delete('applications/{id}', 'ApplicationsController@delete');

Route::get('schedule', 'ScheduleController@get');
Route::post('schedule', 'ScheduleController@post');
Route::post('schedule/{id}', 'ScheduleController@edit');
Route::delete('schedule/{id}', 'ScheduleController@delete');

Route::post('comment', 'NewsController@postComments');
Route::delete('comment/{id}', 'NewsController@deleteComment');

Route::post('login', 'UserController@userLogin');