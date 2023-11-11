<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherForecastRequest;
use App\Http\Resources\WeatherForecastResource;
use App\Services\WeatherForecastService;

class WeatherForcastController extends Controller
{
    public $weatherForecastService;

    public function __construct(WeatherForecastService $weatherForecastService)
    {
        $this->weatherForecastService = $weatherForecastService;
    }

    public function getWeatherForecasts(WeatherForecastRequest $request)
    {
        $validated = $request->validated();
        
        $response = $this->weatherForecastService->getWeatherForecast($validated['location']);

        return new WeatherForecastResource($response);
    }
}
