<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use function GuzzleHttp\Promise\all;

class FileHelper
{
    public static function storeArray($array, $disk="public")
    {
        $document_links = [];
        foreach($array as $file){
            $document_links[]  = $file->store('' , $disk);
        }

        return $document_links;
    }


    /**
     * @param
     * @return array
     */
    public static function storeAllValidFiles($fileTree , $allow=[], $applyAllow = true)
    {
        $ret=[];
        foreach ($fileTree as $key => $file){
            if (!in_array($key , $allow) && $applyAllow) continue;

            if (is_array($file)) {
                $ret[$key] = self::storeAllValidFiles($file , [],  false);
            }
            else{
                $ret[$key] = $file->store(Auth::id() ? Auth::id() : "uploads",'public');
            }
        }

        return $ret;
    }





    public static function FileLinkReplaceInRequest(&$request, $files)
    {
        $merge = [];
        foreach ($files as $key => $value){
            $merge[$key] =  is_array($value) ? static::array_merge_recursive_custom($request->input($key , []) , $value) : $value;
        }

        $request = (new (get_class($request))())->merge($request->except(array_keys($files))); // remove all keys file
        $request->merge($merge);// append all uploaded links
    }




    public static function array_merge_recursive_custom(array $array1, array $array2)
    {
        $merged = $array1;

        foreach ($array2 as $key => & $value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = static::array_merge_recursive_custom($merged[$key], $value);
            } else if (is_numeric($key)) {
                if (!in_array($value, $merged)) {
                    $merged[] = $value;
                }
            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }


    public static function UploadAllowFields(&$request , $allow , $ignore=[])
    {
        $store = FileHelper::storeAllValidFiles($request->allFiles() , array_diff($allow , $ignore));
        FileHelper::FileLinkReplaceInRequest($request , $store);
    }
}

