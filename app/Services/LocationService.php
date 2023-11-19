<?php

namespace App\Services;

use App\Traits\GuzzleRequest;

class LocationService
{
    use GuzzleRequest;

    public function getPlaceDetails($data)
    {
        try {
            $uri = env('FOURSQUARE_PLACES_URI');
            $filters = 'near=' . $data;

            $response = $this->httpRequest($uri, $filters, true);

            $responseContent = $response->getBody()->getContents();

            return json_decode($responseContent, true);
        } catch (\Exception $e) {
            return [
                'code' => 404 
            ];
        }
    }
}
