<?php
namespace App\Services;

use App\Models\Car;
use App\Models\Deal;
use App\Models\File;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\UploadedFile;

class FileService
{
    public function upload(UploadedFile $uploadedFile, $modelType, $modelId, $isAct = false)
    {
        $path = $uploadedFile->store('uploads', 'public');

        $file = new File([
            'filename' => $uploadedFile->getClientOriginalName(),
            'path' => $path,
            'filesize' => $uploadedFile->getSize(),
        ]);

        $model = $this->getModelInstance($modelType, $modelId);

        if ($isAct && $model instanceof Car) {
            $file->fileable_type = get_class($model);
            $file->fileable_id = $model->id;
            $file->is_special = true;
            $file->save();
            // Remove existing act file if present
            if ($model->actFile) {
                $model->actFile->delete();
            }
            $model->actFile()->associate($file);
            $model->save();
        } else {
            $model->files()->save($file);
        }

        return $file;
    }

    protected function getModelInstance($modelType, $modelId)
    {
        switch ($modelType) {
            case 'user':
                return User::findOrFail($modelId);
            case 'car':
                return Car::findOrFail($modelId);
            case 'deal':
                return Deal::findOrFail($modelId);
            case 'service':
                return Service::findOrFail($modelId);
            default:
                throw new \Exception("Invalid model type");
        }
    }
}
