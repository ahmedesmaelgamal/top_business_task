<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeRecource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
                        'name'=>$this->name,
            'id'=>$this->id,
            'email'=>$this->email,
            'salary'=>$this->salary,


        ];
    }
}
