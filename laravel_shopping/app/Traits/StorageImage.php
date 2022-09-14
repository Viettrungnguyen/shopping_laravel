<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImage
{
    public function storageImage($request, $fileName, $folderName)
    {
        if ($request->hasFile($fileName)) {
            $file = $request[$fileName];
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            // $filePath = $request->file($fileName)->storeAs('public/' . $folderName . '/' . Auth::user()->id, $fileNameHash);
            $filePath = $request->file($fileName)->storeAs('public/' . $folderName . '/' . '2', $fileNameHash);
            $dataUpload = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUpload;
        }
        return null;
    }
}
