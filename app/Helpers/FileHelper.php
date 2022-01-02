<?php

namespace App\Helpers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class FileHelper
{
    private const DISK = 'public';
    public static $dir = '';

    public static function upload($file)
    {
        $file_name = (!empty($file->getClientOriginalName())) ? $file->getClientOriginalName() : basename($file);

        return Self::putFile($file, $file_name);
    }

    public static function putFile($file, string $file_name = null)
    {
        $random = \Str::random(rand(10, 50)).time();
        $key = sha1($random);
        $file_name = str_replace(' ', '-', $file_name);
        $full_path = date('Y/m/d')."/".$key."/".$file_name;
        $full_path = (!empty(Self::$dir)) ? Self::$dir.'/'.$full_path : $full_path;
        Storage::disk(env('FILE_STORAGE', Self::DISK))->put($full_path, file_get_contents($file), 'public');

        return [
            'size' => $file->getSize(),
            'width' => 0,
            'height' => 0,
            'mime_type' => $file->getClientMimeType(),
            'file_name' => $file_name,
            'path' => $full_path,
            'url' => Self::getUrl($full_path)
        ];
    }

    public static function getUrl($path)
    {
        return Storage::disk(env('FILE_STORAGE', Self::DISK))->url($path);
    }

    public static function delete(string $path)
    {
        if (Storage::exists($path)) {
            return Storage::delete($path);
        }

        return false;
    }

    public static function setDir(string $dir)
    {
        Self::$dir = $dir;
        return;
    }
}