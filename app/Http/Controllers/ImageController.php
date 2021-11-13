<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    public function show(string $path = 'default.jpg'): Response
    {
        if(Storage::disk('public')->missing($path)) {
            return abort(404);
        }

        return Image::make('storage/'.$path)->response();
    }

    public function thumbnail(int $width, int $height, string $path = 'default.jpg'): Response
    {
        if(!in_array($width.'x'.$height, (Array)config('sopicms.thumbnail'))) {
            return abort(404);
        }

        $ex = explode('.', $path);
        $thumbnailPath = str_replace('.'.end($ex), '.'.$width.'x'.$height.'.'.end($ex), $path);

        if(Storage::disk('public')->missing($thumbnailPath)) {
            return Image::make('storage/'.$path)
                ->fit($width, $height)
                ->save('storage/'.$thumbnailPath)
                ->response();
        }

        return Image::make('storage/'.$thumbnailPath)->response();
    }
}
