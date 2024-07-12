<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function success()
    {
        return new JsonResponse(
            [
                'success' => true,
                'error' => null
            ]
        );
    }

    public function error(string $message)
    {
        return new JsonResponse(
            [
                'success' => false,
                'error' => $message
            ],
            422
        );
    }

    public function getUser(): User
    {
        return auth()->user();
    }
}
