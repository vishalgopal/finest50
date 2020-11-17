<?php

namespace App\ImageFilter;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Square implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(300, 300);
    }
}