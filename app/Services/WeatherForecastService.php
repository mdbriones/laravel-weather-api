<?php

namespace App\Services;

use App\Traits\GuzzleRequest;

class WeatherForecastService
{
    use GuzzleRequest;

    public function getWeatherForecast($data)
    {
        try {
            $uri = 'https://api.openweathermap.org/data/2.5/forecast?';
            $filters = 'q=' . $data . '&appid=' . env('OPENWEATHER_API');

            $response = $this->httpRequest($uri, $filters, false);

            $responseContent = $response->getBody()->getContents();

            return json_decode($responseContent, true);

        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), '404')) {
                return response()->json(['error' => 'city not found']);
            }
            
            return 'Unexpected error: ' . $e->getMessage();
        }
    }
}
