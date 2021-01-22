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

// Dashboard

Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard')->middleware('auth');
Route::get('/dashboard/blogs', 'DashboardController@blogs')->name('dashboard.blogs')->middleware('auth');
Route::get('/dashboard/blog/create', 'DashboardController@newblog')->name('dashboard.newblog')->middleware('auth');
Route::get('/dashboard/blog/edit/{slug}', 'DashboardController@editblog')->name('dashboard.editblog')->middleware('auth');
Route::get('/dashboard/comments', 'DashboardController@comments')->name('dashboard.comments')->middleware('auth');
Route::get('/dashboard/reviews', 'DashboardController@reviews')->name('dashboard.reviews')->middleware('auth');
Route::get('/dashboard/questions', 'DashboardController@questions')->name('dashboard.questions')->middleware('auth');
Route::get('/dashboard/answers', 'DashboardController@answers')->name('dashboard.answers')->middleware('auth');
Route::get('/dashboard/profile', 'DashboardController@profile')->name('dashboard.profile')->middleware('auth');
Route::get('/dashboard/followers', 'DashboardController@followers')->name('dashboard.followers')->middleware('auth');
Route::get('/dashboard/followings', 'DashboardController@followings')->name('dashboard.followings')->middleware('auth');
Route::get('/dashboard/chat', 'DashboardController@messages')->name('dashboard.chat')->middleware('auth');
Route::get('/dashboard/timeline', 'DashboardController@timeline')->name('dashboard.timeline')->middleware('auth');
Route::get('/dashboard/activity', 'DashboardController@activities')->name('dashboard.activities')->middleware('auth');
Route::post('/user/flag', 'DashboardController@toggleFlag')->name('toggleflag')->middleware('auth');
Route::post('ckeditor/upload', 'DashboardController@editorupload')->name('ckeditor.upload');
Route::post('/dashboard/media', 'DashboardController@storeMedia')->name('dashboard.storeMedia');
Route::post('/dashboard/storeimage', 'DashboardController@storeimage')->name('dashboard.storeimage');
Route::post('/dashboard/deletemedia', 'DashboardController@deletemedia')->name('dashboard.deletemedia');
Route::post('/dashboard/updateavatar', 'DashboardController@updateavatar')->name('dashboard.updateavatar');
Route::post('/dashboard/storevideo', 'DashboardController@storevideo')->name('dashboard.storevideo');
Route::post('/dashboard/deletevideo', 'DashboardController@deletevideo')->name('dashboard.deletevideo');

// City / State

Route::post('/getState', 'FormController@getState');
Route::post('/getCity', 'FormController@getCity');

// Social Route
Route::get('auth/social', 'Auth\LoginController@show')->name('social.login');
Route::get('oauth/{driver}', 'Auth\LoginController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');

// Auth Route
Auth::routes();
// Custom Auth
Route::get('signup', 'OtpAuthController@registerPage')->name('signup');
Route::post('optregister', 'OtpAuthController@register');

Route::post('optlogin', 'OtpAuthController@login')->name('optlogin');
Route::post('verifyotp', 'OtpAuthController@verifyotp')->name('verifyotp');

Route::get('signin', 'OtpAuthController@loginPage')->name('signin');
Route::post('signin', 'OtpAuthController@loginWithOtp')->name('signinotp');

Route::post('resendotp', 'OtpAuthController@resendOtp')->name('resendotp');


// Route::get('loginWithOtp', function () {
//     return view('auth/OtpLogin');
// })->name('loginWithOtp');


Route::post('sendOtp', 'OtpAuthController@sendOtp');

// Home
Route::get('/', 'HomeController@index')->name('home');
Route::get('/timeline', 'HomeController@timeline')->name('timeline');
include ('image.php');

// Forms
Route::post('home/submit', 'FormController@storeHomeQnA');
Route::post('home/newsletter', 'FormController@storeNewsletter');
Route::post('contact/submit', 'FormController@contactFrom');


// QnA
Route::get('question/{question}', 'QnAController@showQuestion')->name('question');
Route::get('questions', 'QnAController@showAllQuestions')->name('questions');
Route::post('answer/like', 'QnAController@likeAnswer')->middleware('auth');
Route::delete('answer/delete/{answerid}', 'QnAController@deleteanswer')->middleware('auth');
Route::post('answer/submit', 'QnAController@answerSubmit')->middleware('auth');
Route::post('answer/answeredit', 'QnAController@answerEdit')->middleware('auth');



// Users
Route::get('members/{categories?}', 'UserController@search')->name('members');
Route::get('categories', 'UserController@categories')->name('categories');
Route::get('member/{username}', 'UserController@profile')->name('profile');
Route::get('member/{username}/blogs', 'BlogController@listMember')->name('memberblogs');

Route::post('member/question', 'UserController@askQuestion')->name('ask.question')->middleware('auth');
Route::post('member/chat', 'UserController@requestchat')->name('ask.chat')->middleware('auth');
Route::post('member/consultation', 'UserController@bookConsultation')->name('book.consutation')->middleware('auth');
Route::post('member/review', 'UserController@rateReview')->name('rate.review')->middleware('auth');
Route::post('member/follow', 'UserController@userFollow')->middleware('auth');

Route::post('user/update', 'UserController@updateprofile')->middleware('auth');
Route::post('user/updateimages', 'UserController@uploadUserImages')->middleware('auth');


// Blog
Route::get('blogs/{categories?}', 'BlogController@list')->name('blogs');
Route::get('blog/{blogslug?}', 'BlogController@single')->name('blog');
Route::post('blog/like', 'BlogController@likeBlog')->middleware('auth');
Route::post('blog/save', 'BlogController@saveblog')->middleware('auth');
Route::post('blog/update/{blogid}', 'BlogController@updateblog')->middleware('auth');
Route::delete('blog/delete/{blogid}', 'BlogController@deleteblog')->middleware('auth');

Route::post('comment/submit', 'BlogController@storeComment');
Route::delete('comment/delete/{commentid}', 'BlogController@deletecomment')->middleware('auth');

//Search

Route::get('search/{type}/{query}', 'SearchController@ajaxcall')->name('search');

include "admin.php";
