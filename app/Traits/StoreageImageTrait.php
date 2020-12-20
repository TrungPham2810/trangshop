<?php
/**
 * Created by PhpStorm.
 * User: Trung Pham
 * Date: 12/13/2020
 * Time: 10:40 PM
 */

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait StoreageImageTrait
{
    public function storageImgUpload($request, $fileName, $folderName)
    {
        if($request->hasFile($fileName)) {
            $file =$request->$fileName;
            $fileNameOriginal = $file->getClientOriginalName();
            $fileNameHasd = str_random(20).'.'.$file->getClientOriginalExtension();
            $path = $request->file($fileName)->storeAs('public/'.$folderName, $fileNameOriginal);
            $filePath = Storage::url($path);
            return [
                'file_name'=> $fileNameOriginal,
                'file_path'=> $filePath
            ];
        }
        return [];

    }

    public function storageImgUploadMultile($fileImage, $folderName)
    {
        if($fileImage) {
            $fileNameOriginal = $fileImage->getClientOriginalName();
            $fileNameHasd = str_random(20).'.'.$fileImage->getClientOriginalExtension();
            $path = $fileImage->storeAs('public/'.$folderName, $fileNameOriginal);
            $filePath = Storage::url($path);
            return [
                'file_name'=> $fileNameOriginal,
                'file_path'=> $filePath
            ];
        }
        return [];

    }
}