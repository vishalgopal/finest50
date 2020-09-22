<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

// Social Route
Route::get('auth/social', 'Auth\LoginController@show')->name('social.login');
Route::get('oauth/{driver}', 'Auth\LoginController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');

// Auth Route
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
include ('image.php');

// Forms
Route::post('home/submit', 'FormController@storeHomeQnA');
Route::post('home/newsletter', 'FormController@storeNewsletter');
Route::post('contact/submit', 'FormController@contactFrom');


// QnA
Route::get('question/{question}', 'QnAController@showQuestion')->name('question');
Route::post('answer/like', 'QnAController@likeAnswer')->middleware('auth');


// Users
Route::get('members/{categories?}', 'UserController@search')->name('members');
Route::get('member/{username}', 'UserController@profile')->name('profile');

Route::post('member/question', 'UserController@askQuestion')->name('ask.question')->middleware('auth');
Route::post('member/consultation', 'UserController@bookConsultation')->name('book.consutation')->middleware('auth');
Route::post('member/review', 'UserController@rateReview')->name('rate.review')->middleware('auth');
Route::post('member/follow', 'UserController@userFollow')->middleware('auth')->middleware('auth');


// Blog
Route::get('blogs/{categories?}', 'BlogController@list')->name('blogs');
Route::get('blog/{blogslug?}', 'BlogController@single')->name('blog');
Route::post('comment/submit', 'BlogController@storeComment');


