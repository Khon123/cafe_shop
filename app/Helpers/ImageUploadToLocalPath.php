<?php
/**
 * Created by PhpStorm.
 * User: sokho
 * Date: 7/21/2017
 * Time: 2:22 PM
 */

namespace app\Helpers;


use Intervention\Image\Facades\Image;

class ImageUploadToLocalPath
{
    public static function storeImage($image, $path){
        $image     = $image;
        $imageName = time().'.'. $image->getClientOriginalExtension();
        $path      = $path;
        Image::make($image->getRealPath())->resize(300,300, function ($constrain){
            $constrain->aspectRatio();
        })->save($path.'/'.$imageName);

        return $imageName;
    }
}