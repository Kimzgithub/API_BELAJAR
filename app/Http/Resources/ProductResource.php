<?php
 
namespace App\Http\Resources;
 
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
 
class ProductResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => 'Rp ' . number_format($this->price, 0, ',', '.'),
            'stock'       => $this->stock,
            'created_at'  => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
