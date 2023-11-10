<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\WeatherForcast;
use App\Traits\GuzzleRequest;

class WeatherForcastController extends Controller
{
    use GuzzleRequest;

    public function __invoke(LocationRequest $request)
    {
        try {
            $validated = $request->validated();
    
            $uri = 'https://api.openweathermap.org/data/2.5/forecast?';
            $filters = 'q=' . $validated['location'] . '&appid=' . env('OPENWEATHER_API');

            $response = $this->httpRequest($uri, $filters, false);
    
            return $response->getBody();

        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), '404')) {
                return response()->json(['error' => 'city not found']);
            }
            
            return 'Unexpected error: ' . $e->getMessage();
        }
    }
}
