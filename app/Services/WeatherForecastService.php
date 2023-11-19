<?php

namespace App\Services;

use App\Traits\GuzzleRequest;

class WeatherForecastService
{
    use GuzzleRequest;

    public function getWeatherForecast($data)
    {
        try {
            $uri = env('OPENWEATHER_URI');
            $filters = 'q=' . $data . '&appid=' . env('OPENWEATHER_API') . '&units=metric';

            $response = $this->httpRequest($uri, $filters, false);

            $responseContent = $response->getBody()->getContents();

            return json_decode($responseContent, true);

        } catch (\Exception $e) {
            return [
                'code' => 404 
            ];
            // return response()->json(['error' => 'No City Available'], $e->getCode());
        }
    }
}
