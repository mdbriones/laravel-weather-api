<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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

        $sunriseCarbon = Carbon::createFromTimestamp($data['city']['sunrise']);
        $sunsetCarbon = Carbon::createFromTimestamp($data['city']['sunset']);

        $results['city'] = [
            'name' => $data['city']['name'],
            'sunrise' => $sunriseCarbon->format('Y-m-d H:i:s A'),
            'sunset' => $sunsetCarbon->format('Y-m-d H:i:s A'),
        ];

        // Group forecasts by date
        $groupedForecasts = collect($data['list'])->groupBy(function ($item) {
            return date('l, F d, Y', strtotime($item['dt_txt']));
        });

        foreach ($groupedForecasts as $date => $forecasts) {
            $dailyInfo = [
                'dt_txt' => $date,
                'info' => [],
            ];

            foreach ($forecasts as $forecast) {
                $weather = current($forecast['weather']);

                $main = [
                    'weather_icon' => $weather['icon'],
                    'weather_temp' => html_entity_decode($forecast['main']['temp'] . " &deg;C"),
                    'humidity' => $forecast['main']['humidity'] . '%',
                    'weather_description' => ucwords($weather['description']),
                    'wind_speed' => $forecast['wind']['speed'] . ' meter/sec',
                    'wind_direction' => $this->getWindDirection($forecast['wind']['deg']),
                    'dt_txt' => date('h:i A', strtotime($forecast['dt_txt'])),
                ];

                $dailyInfo['info'][] = $main;
            }

            $results['weather_info'][] = $dailyInfo;
        }

        return $results;

    }

    public function getWindDirection($degrees) {
        $directions = [
            'N', 'NNE', 'NE', 'ENE',
            'E', 'ESE', 'SE', 'SSE',
            'S', 'SSW', 'SW', 'WSW',
            'W', 'WNW', 'NW', 'NNW'
        ];
    
        $index = round($degrees / 22.5) % 16;
    
        return $directions[$index];
    }
}
