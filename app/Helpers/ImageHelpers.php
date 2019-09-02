<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 11/02/2018 02:41 PM
 */

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;

class ImageHelpers
{
    public static $imagine;
    public static $host;

    /**
     * @param string $src
     * @param int $x
     * @param int $y
     */
    public static function crop($src, $x, $y,  $disk = 'public')
    {
        $x = $x/2;
        $y = $y/2;

        $filePath = str_replace('/storage/', '', $src);

        if (!Storage::disk($disk)->exists($filePath)) {
            return false;
        }

        $imagine = new Imagine();
        $fileInfo = pathinfo($filePath);

        if (!empty($fileInfo)) {
            $extension = $fileInfo['extension'];
        } else {
            $extension = explode('.', $filePath);
            $extension = end($extension);
        }

        $fileOpen = $imagine->open('storage/' . $filePath);
        $size = $fileOpen->getSize();
        $width = $size->getWidth();
        $height = $size->getHeight();

        $widthCropped = 0;
        $heightCropped = 0;

        if ($width/2 - $x > 0) {
            $widthCropped = $width/2 - $x;
        }

        if ($height/2 - $y > 0) {
            $heightCropped = $height/2 - $y;
        }

        return $fileOpen->crop((new Point($widthCropped, $heightCropped)), (new Box($x, $y))->scale(2))->show($extension);
    }

    public static function resize($src, $x, $y, $disk = 'public')
    {
        $filePath = self::handlerSourcePath($src);
        $uploadPath = config('params.upload_path', 'uploads');

        if (!Storage::disk($disk)->exists($filePath)) {
            return false;
        }

        $imagine = new Imagine();
        $dirname = '';
        $fileInfo = pathinfo($filePath);
        $pathCode = static::handlePath($x, $y);

        if (isset($fileInfo['dirname']) && !empty($fileInfo['dirname'])) {
            $dirname = static::removeStoragePath($fileInfo['dirname']);
            $dirname = static::removeUploadPath($dirname);
        }

        $resizePath = rtrim(ltrim(config('params.resizePath', 'resize'), '\\/'), '/\\');
        $resizeFile = "$uploadPath/$resizePath/$pathCode/$dirname/{$fileInfo['filename']}.{$fileInfo['extension']}";

        if (!Storage::disk($disk)->exists($resizeFile)) {
            if (!Storage::disk($disk)->exists("$uploadPath/$resizePath/$pathCode/$dirname")) {
                Storage::disk($disk)->makeDirectory("$uploadPath/$resizePath/$pathCode/$dirname/");
            }

            $fileOpen = $imagine->open('storage/' . $filePath);
            $fileCrop = $fileOpen->resize((new Box($x, $y))->scale(2));

            Storage::disk($disk)->put($resizeFile, $fileCrop);

            return $resizeFile;
        }

        return $resizeFile;
    }

    public static function getThumbnailLink($src, $x = null, $y = null, $crop = false)
    {
        $uploadPath = config('params.upload_path', 'storage');
        $cropPath = config('params.cropPath', 'crop');
        $resizePath = config('params.resizePath', 'resize');
        $pathCode = static::handlePath($x, $y);
        $src = str_replace($uploadPath, '', $src);
        $src = ltrim($src, '\\/');
        $uploadPath = 'storage/' . $uploadPath;

        if ($crop) {
            return $uploadPath . '/' . $cropPath . '/' . $pathCode . '/' . $src;
        }

        return $uploadPath . '/' . $resizePath . '/' . $pathCode . '/' . $src;
    }

    public static function isExistsThumbnail($src, $disk = 'public')
    {
        $src = str_replace('storage', '', $src);
        $src = ltrim($src, '\\/');

        if (!Storage::disk($disk)->exists($src)) {
            return false;
        }

        return true;
    }

    public static function deleteThumbnailLink($src, $x, $y, $disk = 'public', $crop = false)
    {
        $src = str_replace('storage', '', self::getThumbnailLink($src, $x, $y, $crop));
        $src = ltrim($src, '\\/');

        return Storage::disk($disk)->delete($src);
    }

    public static function handlePath($x = null, $y = null)
    {
        $folderName = 'freesize';

        if ($x !== null && $y !== null) {
            $folderName = $x . '_' . $y;
        } elseif ($x !== null && $y === null) {
            $folderName = "w$x";
        } elseif ($x === null && $y !== null) {
            $folderName = "h$y";
        }

        return $folderName;
    }

    /**
     * Handler file src
     *
     * @param $src
     *
     * @return string|void
     */
    public static function handlerSourcePath($src)
    {
        if (empty($src)) {
            return null;
        }

        $host = env('APP_URL');
        $uploadPath = config('params.uploadPath', 'storage');

        $src = str_replace($host, '', $src);
        $image = ltrim(trim($src), '\\/');
        $image = str_replace($uploadPath, '', $image);
        $image = ltrim($image, '\\/');
        $image = "$uploadPath/$image";

        return $image;
    }

    public static function removeStoragePath($src) :? string
    {
        if (empty($src)) {
            return null;
        }

        return ltrim(ltrim($src, 'storage'), '\\/');
    }

    public static function removeUploadPath($src)
    {
        if (empty($src)) {
            return null;
        }

        return ltrim(ltrim($src, 'storage'), '\\/');
    }
}