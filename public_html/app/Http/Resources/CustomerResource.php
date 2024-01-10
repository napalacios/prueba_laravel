<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{   

    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        return [
            'name' => $this->name,
            'last_name' => $this->last_name,
            'adress' => ($this->adress) ? $this->adress : null,
            'description_region' => $this->region->description,
            'description_commune' => $this->commune->description,
        ];
    }
}