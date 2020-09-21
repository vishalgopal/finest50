<?php 
use Intervention\Image\ImageManager;
Route::get('imager/{src?}', function ($src)
{
   $cacheimage = Image::cache(function($image) use ($src) {
       return $image->make(asset("images/blogs")."/".$src)->resize(100,50);
   }, 10, true);

   return Response::make($cacheimage, 200, array('Content-Type' => 'image/jpeg'));
// print( $cacheimage);
});

?>