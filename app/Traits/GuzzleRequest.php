<?php
namespace App\Traits;

use GuzzleHttp\Client;

trait GuzzleRequest {
    public $client;

    public function __construct()
    {
        $this->client = new Client;
    }

    public function httpRequest($uri, $filters, $authorization = false)
    {
        $url = $uri . $filters;

        return $this->client->request('GET', $url, [
            'headers' => [
                'Authorization' => $authorization === true ? env('FOURSQUARE_PLACES_API_KEY') : null,
                'accept' => 'application/json',
            ],
        ]);
    }
}