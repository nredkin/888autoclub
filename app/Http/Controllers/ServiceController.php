<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(private Service $services)
    {

    }

    public function list()
    {
        $services = $this->services::all();
        return new JsonResponse(['services' => ServiceResource::collection($services)]);
    }


}
