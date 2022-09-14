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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'tile' => $this->title,
            'gender' => $this->gender,
            'avatar_url' => $this->avatar_url,
            'education' => $this->education,
            'location' => $this->location,
            'skills' => $this->skills,
            'note' => $this->note,
            'birthday' => $this->birthday,
            'is_active' => $this->is_active,
            'phone' => $this->phone,
            'slug' => $this->slug,
            'role' => $this->role,
            'avatar_name'=>$this->avatar_name
        ];
        // return parent::toArray($request);
    }
}
