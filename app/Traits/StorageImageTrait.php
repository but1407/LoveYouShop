<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait StorageImageTrait{
    public function storageImageUpload($request, $fieldName, $folderName){
        if ($request->hasFile($fieldName)) {
            try {
                $file = $request->file($fieldName);
                $fileNameOriginal = $file->getClientOriginalName();
                $fileNameHash = str_random(20) . '.' . $file->getClientOriginalExtension();
                $pathFull = $folderName  .'/' . auth()->id() . '/' . date("Y/m/d");

                $filePath = $request->file($fieldName)->storeAs('public/' . $pathFull, $fileNameHash);
                $dataUpaloadTrait = [
                    'file_name' => $fileNameOriginal,
                    'file_path' => Storage::url($filePath),
                    // 'url' => '/storage/' . $pathFull . '/' . $fileNameHash,
                ];
                return $dataUpaloadTrait;
            } catch (\Exception $error) {

                return false;
            }
        }
    }
    public function storageImageUploadMultiple($file, $folderName){
        try {
            $fileNameOriginal = $file->getClientOriginalName();
            $fileNameHash = str_random(20) . '.' . $file->getClientOriginalExtension();
            $pathFull = $folderName  .'/' . auth()->id() . '/' . date("Y/m/d");

            $filePath = $file->storeAs('public/' . $pathFull, $fileNameHash);
            $dataUpaloadTrait = [
                'file_name' => $fileNameOriginal,
                'file_path' => Storage::url($filePath),
                // 'url' => '/storage/' . $pathFull . '/' . $fileNameHash,
            ];
            return $dataUpaloadTrait;
        } catch (\Exception $error) {

            return false;
        }
    }
}