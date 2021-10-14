<?php


namespace App\Services\File;

use App\Models\Exercise;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class FileService
{
    public function uploadExerciseImage($images, $exerciseId)
    {
        if($images){
        foreach ($images as $image){
            $fileModel = new File;
            $fileName = $image->getClientOriginalName();
            $filePath =  $image->storeAs($id = Auth::id().'/exercise'.$exerciseId, $fileName, 'public');
            $fileModel->name = $fileName;
            $fileModel->user_id = Auth::id();
            $fileModel->file_path = $filePath;
            $fileModel->fileable_id = $exerciseId;
            $fileModel->fileable_type = Exercise::class;
            $fileModel->save();
            }
        }

    }
}
