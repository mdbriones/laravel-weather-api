<?php

namespace App\Http\Controllers;


use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationDetailsResource;
use App\Services\LocationService;

class LocationController extends Controller
{
    public $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function getNearbyPlaces(LocationRequest $request)
    {
        $validated = $request->validated();
        
        $response = $this->locationService->getPlaceDetails($validated['location']);

        if (isset($response['code'])) {
            return [];
        }
        
        return new LocationDetailsResource($response);
    }
}
