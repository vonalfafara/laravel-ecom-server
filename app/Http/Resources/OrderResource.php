<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "product_name" => $this->product->name,
            "price" => (float) $this->product->price,
            "quantity" => $this->quantity,
            "total" => ((float) $this->product->price) * ((int) $this->quantity)
        ];
    }
}
