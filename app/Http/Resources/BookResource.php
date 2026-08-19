<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'author'      => $this->author,
            'image' => $this->image,
            'description' => $this->description,
            'created_at'  => $this->created_at->toIso8601String(),

            'category'    => [
                /**
                 * 'id' => $this->category?->id
                 * Это спасет твой API от критической ошибки Attempt to read property "id" on null, если у какой-то книги в базе случайно сотрется или не укажется категория.
                 * Отличная подстраховка!
                 */
                'id'   => $this->category?->id,
                'title' => $this->category?->title,
            ],
        ];
    }
}
