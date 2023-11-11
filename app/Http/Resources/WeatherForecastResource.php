<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherForecastResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = $this;

        $results = [];

        $results['city'] = [
            'name' => $data['city']['name'],
            'sunrise' => date('F d, Y h:i', $data['city']['sunrise']),
            'sunset' => date('F d, Y h:i', $data['city']['sunset']),
        ];

        foreach ($data['list'] as $forecast) {
            $weather = current($forecast['weather']);
            
            $main = [
                'weather_temp' => $forecast['main']['temp'],
                'humidity' => $forecast['main']['humidity'],
                'weather_label' => $weather['main'],
                'weather_description' => $weather['description'],
                'weather_icon' => $weather['icon'],
                'wind_speed' => $forecast['wind']['speed'],
                'dt_txt' => $forecast['dt_txt']
            ];

            $results['weather_info'][] = $main;
        }

        return $results;
    }
}
