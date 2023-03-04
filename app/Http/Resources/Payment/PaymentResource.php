<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        return [
            'customer_id' => $this->customer_id,
            'amount' => $this->amount,
            'reference_id' => $this->reference_id,
            'transaction_id' => $this->transaction_id,
            'status' => $this->status,
            'comments' => $this->comments,
                       
        ];
    }
}
