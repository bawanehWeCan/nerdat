<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarkResource extends JsonResource
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

            'id'=>$this->id,
            'is_correct'=> $this->is_correct,
            'question'=>$this?->question?->id,
            'answer'=>$this?->answer?->id,
            'result'=>$this?->result?->id,
            'user'=>$this?->user?->id,

        ];
    }
}
