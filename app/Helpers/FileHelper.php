<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/27/2019 11:44 AM
 */

namespace App\Helpers;


use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public static function upload($file, $dir = 'uploads', $rename = '', &$errors = [])
    {
        $extension = $file->getClientOriginalExtension();

        if (!$rename) {
            $fileName = $file->getClientOriginalName();
        } else {
            $fileName = $rename  . '.' . $extension;
        }

        try{
            return $file->storeAs($dir, $fileName, 'public');
        } catch (\Exception $exception) {
            $errors = $exception->getMessage();

            return false;
        }
    }
}