<?php

namespace App\Http\Controllers;


use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationDetailsResource;
use App\Services\LocationService;
use App\Traits\GuzzleRequest;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function __invoke(LocationRequest $request)
    {
        $validated = $request->validated();
        
        $response = $this->locationService->getLocationDetails($validated['location']);

        return new LocationDetailsResource($response);
    }
}
