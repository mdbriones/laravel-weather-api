<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LocationDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = $this['results'];
        $results = [];

        foreach ($data as $item) {
            $result = [
                // 'fsq_id' => $item['fsq_id'],
                'categories' => $item['categories'],
                'closed_bucket' => $item['closed_bucket'],
                'location' => $item['location'],
                'name' => $item['name'],
            ];

            $results[] = $result;
        }

        return [
            'results' => $results
        ];
    }
}
