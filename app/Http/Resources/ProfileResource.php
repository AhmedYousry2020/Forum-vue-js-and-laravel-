<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            "user"=>$this->user,
            "discussions"=>DiscussionResource::collection($this->user->discussions),
            "image"=>$this->image,
            "about"=>$this->about,
            "facebook"=>$this->facebook,
            "twitter"=>$this->twitter

        ];
    }
}
