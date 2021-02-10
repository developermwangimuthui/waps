<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'=>$this->id,
            'first_name'=>$this->first_name,
            'surname'=>$this->surname,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'county'=>$this->county,
            'country'=>$this->country,
            'plate_no'=>$this->plate_no,
            'model'=>$this->model,
            'year'=>$this->year,
            'profile_pic_path'=> url('UserProfilePics', $this->profile_pic_path),
            'user_type'=>$this->user_type,
            'created_at'=>$this->created_at->format('d M, yy'),
            'token' =>  $this->createToken('token')->accessToken,
        ];
    }
}
