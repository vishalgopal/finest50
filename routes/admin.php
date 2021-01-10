<?php 


//user CRUD
Route::get('books', 'Admin\AdminActivityLogController@index');
Route::get('book/add', 'Admin\AdminActivityLogController@create');
Route::post('book/store', 'Admin\AdminActivityLogController@store');
Route::get('book/edit/{id}', 'Admin\AdminActivityLogController@edit');
Route::post('book/update', 'Admin\AdminActivityLogController@update');
Route::post('book/delete_data', 'Admin\AdminActivityLogController@delete');

?>