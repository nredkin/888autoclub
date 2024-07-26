<?php
namespace App\Services;

use App\Models\Car;
use App\Models\Deal;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class FileService
{
    public function upload(UploadedFile $uploadedFile, $modelType, $modelId)
    {
        $path = $uploadedFile->store('uploads', 'public');

        $file = new File([
            'filename' => $uploadedFile->getClientOriginalName(),
            'path' => $path,
            'filesize' => $uploadedFile->getSize(),
        ]);

        $model = $this->getModelInstance($modelType, $modelId);
        $model->files()->save($file);

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
