<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileResource;
use App\Models\Car;
use App\Models\Deal;
use App\Models\File;
use App\Models\Service;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function __construct(private File $file, FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function upload(Request $request, $modelType, $modelId)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $uploadedFile = $request->file('file');

        $isAct = filter_var($request->input('act', false), FILTER_VALIDATE_BOOLEAN);

        $file = $this->fileService->upload($uploadedFile, $modelType, $modelId, $isAct);

        return response()->json(['message' => 'Файл успешно загружен', 'file' => $file]);
    }

    public function index($modelType, $modelId)
    {
        $model = $this->getModelInstance($modelType, $modelId);
        $files = $model->files()->where('is_special', 0)->get();
        return FileResource::collection($files);
    }

    public function getFileById($id)
    {
        $file = $this->file->findOrFail($id);

        if (!$file) {
            return $this->error('Файл не найден');
        }

        return new JsonResponse(['file' => FileResource::make($file)]);
    }

    public function download($id)
    {
        $file = $this->file->findOrFail($id);
        $filePath = storage_path('app/public/' . $file->path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->download($filePath, $file->filename);
    }

    public function delete($id)
    {
        $file = $this->file->findOrFail($id);

        // Delete the file from storage
        Storage::disk('public')->delete($file->path);

        // Delete the file record from the database
        $file->delete();

        return response()->json(['message' => 'File deleted successfully'], 200);
    }

    private function getModelInstance($modelType, $modelId)
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
