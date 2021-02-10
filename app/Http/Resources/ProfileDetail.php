<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileDetail extends JsonResource
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
            'id'=>$this->id,
            'first_name'=>$this->user->first_name,
            'surname'=>$this->user->surname,
            'email'=>$this->user->email,
            'phone'=>$this->user->phone,
            'profile_pic_path'=> url('DriverPhotos', $this->profile_pic_path),
            'user_type'=>$this->user->user_type,
            'car_number_plate'=>$this->vehicles[0]->car_number_plate,
            'car_model'=>$this->vehicles[0]->car_model,
            'yom'=>$this->vehicles[0]->yom,
//            'front_vehicle_photo'=> url('CarFrontPhotos', $this->->car_front),
//            'back_vehicle_photo'=> url('CarBackPhotos', $this->vehicles[0]->car_back),
            'front_license'=> url('DriverFrontLicense', $this->driverLicenses[0]->front_license),
            'back_license'=> url('DriverBackLicense', $this->driverLicenses[0]->back_license),
            'profile_pic_path'=> url('DriverPhotos', $this->driverPhotos[0]->profile_pic_path),
        ];
    }
}
