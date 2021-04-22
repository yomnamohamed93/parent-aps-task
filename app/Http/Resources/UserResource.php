<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this["id"],
            'balance' => $this["balance"],
            'email' => $this["email"],
            'status' =>  $this["status"],
            'created_at' => $this["created_at"],
            'Currency' => $this["Currency"],
            'dataProvider' => $this["dataProvider"],
        ];
    }

    private function readStatus($statusCode)
    {
        if($statusCode==1 || $statusCode ==100){
            return 'authorised';
        }
        else if($statusCode==1 || $statusCode ==100){
            return 'decline';

        }else return 'refunded';
    }
}
