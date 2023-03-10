<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
        'question'=> $this->question,
        'description'=>$this->description,
        'subject'=>$this?->subject?->name,
        'unit'=>$this?->unit?->name,
        'lesson'=>$this?->lesson?->name,


        ];
    }
}
