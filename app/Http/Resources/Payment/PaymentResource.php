<?php

namespace App\Http\Resources\Payment;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'userId' => $this->user_id,
            'amount' => $this->amount,
            'description' => $this->description,
            'status' => $this->status,
            'createdAt' => Carbon::parse($this->created_at)->format('d M Y'),
        ];
    }
}
