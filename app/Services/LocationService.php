<?php
namespace App\Services;

use App\Traits\GuzzleRequest;

class LocationService {
    
    use GuzzleRequest;

    public function getLocationDetails($data)
    {
        try {
            $uri = 'https://api.foursquare.com/v3/places/search?';
            $filters = 'near=' . $data;

            $response = $this->httpRequest($uri, $filters, true);

            $responseContent = $response->getBody()->getContents();

            return json_decode($responseContent, true);

        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), '404')) {
                return response()->json(['error' => 'City not found']);
            }

            return 'Unexpected error: ' . $e->getMessage();
        }
        
        
    }
}