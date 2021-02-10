<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileDetail;
use App\Models\DriverPhoto;
use App\PasswordReseting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\UserRegisterResource;
use App\Http\Resources\UserLoginResoure;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\File;
use Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Mail\SendMail;
use App\Models\Driver;
use App\Models\DriverLicense;
use App\Models\Vehicle;
use App\Models\VehiclePhoto;

class UserAuthController extends Controller
{
    //----------------- [ Register user ] -------------------
    public function registerUser(UserRegisterRequest $request)
    {

        // check if email already registered
        $user = User::where('phone', $request->phone)->first();
        if (!is_null($user)) {
            return response([
                'error' => true,
                'message' => 'Sorry! this phone number is already registered!',
            ], Response::HTTP_OK);
        } else {
            $user = new User();
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->user_type = $request->user_type;
            $user->first_name = $request->first_name;
            $user->surname = $request->surname;
            $user->country = $request->country;
            $user->county = $request->county;
            $user->uberSwitch = $request->uberSwitch == true ? 1 : 0;

            if ($user->save()) {
                $driver = new Driver();
                $driver->user_id = $user->id;
                //Create a log that the user has visited the site
                visitor()->visit();

                if ($driver->save()) {
                    return response([
                        'error' => false,
                        'message' => 'You have registered successfully',
                        'user' => new UserRegisterResource($user)
                    ], Response::HTTP_CREATED);
                }
            }
        }
    }


    // -------------- [ User Login ] ------------------

    public function userLogin(UserLoginRequest $request)
    {

        $user_status = User::where('phone', $request->phone)->count();
        if ($user_status > 0) {

            Auth::attempt(['phone' => $request->phone, 'password' => $request->password]);

            //was any of those correct ?
            if (Auth::check()) {

                // getting auth user after auth login
                $user = Auth::user();
                //Create a log that the user has visited the site
                visitor()->visit();
                return response([
                    'error' => false,
                    'message' => 'Success! you are logged in successfully',
                    'user' => new UserRegisterResource($user)
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => true,
                    'message' => 'Wrong phone number or password!',
                ], Response::HTTP_OK);
            }
        } else {
            return response([
                'error' => true,
                'message' => 'User with this phone number not found!',
            ], Response::HTTP_OK);
        }
    }


    public function updateProfile(Request $request)
    {


        $user = Auth::user();

        if ($request->phone != null) {

            $user->phone = $request->phone;
        }
        if ($request->email != null) {

            $user->email = $request->email;
        }
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        if ($user->update()) {
            $driver_id = Driver::where('user_id', $user->id)->pluck('id')->first();
            $vehicle = new Vehicle();
            $current_number_plate = Vehicle::where('driver_id', $driver_id)->pluck('car_number_plate')->first();
            $current_car_model = Vehicle::where('driver_id', $driver_id)->pluck('car_model')->first();
            $current_yom = Vehicle::where('driver_id', $driver_id)->pluck('yom')->first();
            if ($request->car_number_plate != null && $current_number_plate != '') {

                $vehicle->where('driver_id', $driver_id)->update([
                    'car_number_plate' => $request->car_number_plate,
                ]);

            } elseif ($request->car_number_plate == null) {
                return response([
                    'error' => true,
                    'message' => 'The car number plate is required.',
                ], Response::HTTP_CREATED);
            } elseif ($request->car_model != null && $current_car_model != '') {
                $vehicle->where('driver_id', $driver_id)->update([
                    'car_model' => $request->car_model,
                ]);
//                $vehicle->car_model = $request->car_model;
            } elseif ($request->car_model == null) {
                return response([
                    'error' => true,
                    'message' => 'The car model plate is required.',
                ], Response::HTTP_CREATED);
            } elseif ($request->yom != null && $current_yom != '') {
                $vehicle->where('driver_id', $driver_id)->update([
                    'yom' => $request->yom,
                ]);
//                $vehicle->yom = $request->yom;
            } elseif ($request->yom == null) {
                return response([
                    'error' => true,
                    'message' => 'The Year of Manufacture plate is required.',
                ], Response::HTTP_CREATED);
            } else {

                $vehicle->car_number_plate = $request->car_number_plate;
                $vehicle->driver_id = $driver_id;
                $vehicle->yom = $request->yom;
                $vehicle->car_model = $request->car_model;
                $vehicle->save();

            }
        }

        $vehicle_photo = new VehiclePhoto();

        $current_front_vehicle_photo = VehiclePhoto::where('driver_id', $driver_id)->pluck('car_front')->first();
        $current_back_vehicle_photo = VehiclePhoto::where('driver_id', $driver_id)->pluck('car_back')->first();

        if ($request->front_vehicle_photo != null && $current_front_vehicle_photo != '') {
            if ($request->hasfile('front_vehicle_photo')) {
                // foreach ($request->file('upl') as $image) {
                $front_vehicle_photo = $request->file('front_vehicle_photo');

                $imgdestination = '/CarFrontPhotos';
                $imgname = $this->generateUniqueFileName($front_vehicle_photo, $imgdestination);
                $vehicle_photo->where('driver_id', $driver_id)->update([
                    'car_front' => $imgname,
                ]);
            } else {
                return response([
                    'error' => true,
                    'message' => ' Car Front Photos is required!',
                ], Response::HTTP_CREATED);
            }
        } elseif ($request->back_vehicle_photo != null && $current_back_vehicle_photo != '') {
            if ($request->hasfile('back_vehicle_photo')) {
                // foreach ($request->file('upl') as $image) {
                $back_vehicle_photo = $request->file('back_vehicle_photo');

                $imgdestination = '/CarBackPhotos';
                $imgname = $this->generateUniqueFileName($back_vehicle_photo, $imgdestination);
                $vehicle_photo->where('driver_id', $driver_id)->update([
                    'car_back' => $imgname,
                ]);
            } else {
                return response([
                    'error' => true,
                    'message' => 'Car Back Photos is required !',
                ], Response::HTTP_CREATED);
            }
        } else {

            $vehicle_photo->car_front = $this->moveUploadedFile($request->front_vehicle_photo, "CarFrontPhotos");;
            $vehicle_photo->car_back = $this->moveUploadedFile($request->back_vehicle_photo, "CarBackPhotos");
            $vehicle_photo->driver_id = $driver_id;
            $vehicle_photo->save();

        }

        $driver_licence = new DriverLicense();

        $current_driver_license_front = DriverLicense::where('driver_id', $driver_id)->pluck('front_license')->first();
        $current_driver_license_back = DriverLicense::where('driver_id', $driver_id)->pluck('back_license')->first();

        if ($request->front_license != null && $current_driver_license_front != '') {
            if ($request->hasfile('front_license')) {
                // foreach ($request->file('upl') as $image) {
                $front_license = $request->file('front_license');

                $imgdestination = '/DriverFrontLicense';
                $imgname = $this->generateUniqueFileName($front_license, $imgdestination);
                $driver_licence->where('driver_id', $driver_id)->update([
                    'front_license' => $imgname,
                ]);
            } else {
                return response([
                    'error' => true,
                    'message' => 'Driver Front License is required!',
                ], Response::HTTP_CREATED);
            }
        } elseif ($request->back_license != null && $current_driver_license_back != '') {
            if ($request->hasfile('back_license')) {
                // foreach ($request->file('upl') as $image) {
                $back_license = $request->file('back_license');

                $imgdestination = '/DriverBackLicense';
                $imgname = $this->generateUniqueFileName($back_license, $imgdestination);
                $driver_licence->where('driver_id', $driver_id)->update([
                    'back_license' => $imgname,
                ]);
            } else {
                return response([
                    'error' => true,
                    'message' => 'Driver back License is required!',
                ], Response::HTTP_CREATED);
            }
        } else {
            $driver_licence->front_license = $this->moveUploadedFile($request->front_vehicle_photo, "DriverFrontLicense");;
            $driver_licence->back_license = $this->moveUploadedFile($request->back_vehicle_photo, "DriverBackLicense");
            $driver_licence->driver_id = $driver_id;
            $driver_licence->save();

        }


        $driver_photo = new DriverPhoto();


        $imgdestination = '/DriverPhotos';
        $current_driver_photo = DriverPhoto::where('driver_id', $driver_id)->pluck('profile_pic_path')->first();

        if ($request->profile_pic_path != null && $current_driver_photo != '') {

            if ($request->hasfile('profile_pic_path')) {
                // foreach ($request->file('upl') as $image) {
                $profile_pic_path = $request->file('profile_pic_path');
                $imgname = $this->generateUniqueFileName($profile_pic_path, $imgdestination);
                $driver_photo->where('driver_id', $driver_id)->update([
                    'profile_pic_path' => $imgname,
                ]);
            } else {
                return response([
                    'error' => true,
                    'message' => 'Driver Front License is required!',
                ], Response::HTTP_CREATED);
            }
        } else {
            $driver_photo->profile_pic_path = $this->moveUploadedFile($request->profile_pic_path, "DriverPhotos");
            $driver_photo->driver_id = $driver_id;
            $driver_photo->save();

        }

        $profileDetais = Driver::with('driverPhotos', 'vehicles', 'driverLicenses', 'user')->where('drivers.user_id', Auth::user()->id)->get();
        $profileDetais = ProfileDetail::collection($profileDetais);
//        dd($profileDetais);

        return response([
            'error' => false,
            'message' => 'Profile updated successfully',
            'profileDetail' => $profileDetais
        ], Response::HTTP_CREATED);

    }


    public function forgot_password(Request $request)
    {
        $rules = [
            'phone' => 'required|phone',
        ];
        // $error = Validator::make($request->all(), $rules);
        $password = str_random(4);


        $phoneexist = User::where('phone', $request->phone)->count();
        // if ($phoneexist <= 0) {
        //     return response([
        //         'error' => true,
        //         'message' => 'User not found',
        //     ], Response::HTTP_OK);
        // } else {
        $digits = 4;
        $token = random_int(10 * ($digits - 1), (10 * $digits) - 1);

        $status = PasswordReseting::where('phone', $request->phone)->count();
        if ($status > 0) {
            $pass = PasswordReseting::where('phone', $request->phone)->first();
            $pass->phone = $request->phone;
            $pass->token = $token;
            $data = [
                'token' => $token,
            ];
            if ($pass->update()) {

                $password_update = User::where('phone', $request->phone)->update([
                    'password' => Hash::make($password),
                ]);
                $phone_number1 = $request->phone;
                // dd($password_update);
                if ($password_update) {


                    $phone_number1 = preg_replace('/^0/', '254', $phone_number1);
                    $phone_number1 = preg_replace('/^7/', '2547', $phone_number1);
                    $phone_number1 = preg_replace('/^1/', '2541', $phone_number1);
                    $curl = curl_init();

                    //$tophone=$pno1;
                    //$message="A client is requesting your product (order no. $ordername). Please login to MyGas app to accept the order";

                    //$CallBackURL = 'https://tumefika.co.ke/admin/callback_url.php';
                    $curl_post_data = array('username' => 'yoosinpaddy', 'api_key' => 'h8f3OgwEVI1t7365C7p55nTJttuEkFDyQNydRMlSG9CBQ8ZF1Q', 'sender' => 'SMARTLINK', 'to' => $phone_number1, 'message' => 'Your Password reset is ' . $password, 'msgtype' => '5', 'dlr' => 'success');
                    $data_string = json_encode($curl_post_data);

                    curl_setopt($curl, CURLOPT_URL, 'https://sms.movesms.co.ke/api/compose');

                    curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-type: application/json", "ApiKey:109dfaa303aa452092a65361e9b4e8d6"]);

                    // curl_setopt($curl, CURLOPT_HEADER, false);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

                    //$curl_response = curl_exec($curl);
                    echo '{"result":"';
                    curl_exec($curl);
                    // if ($result == 'Message Sent: 1701') {

                    echo '",
                        "error" : false,
                        "message" : "Password reset message sent"
                    }';
                    //  }else{

                    // return response([
                    //     'error' => true,
                    //     'message' => 'Failed to send message!',
                    // ], Response::HTTP_OK);
                    //  }

                }
            } else {
                return response([
                    'error' => true,
                    'message' => 'Failed to send message!',
                ], Response::HTTP_OK);
            }
        } else {

            $pass = new PasswordReseting();
            $pass->phone = $request->phone;
            $pass->token = $token;
            $data = [
                'token' => $token,
            ];
            if ($pass->save()) {
                $password_update = User::where('phone', $request->phone)->update([
                    'password' => Hash::make($password),
                ]);
                if ($password_update) {
                    $curl = curl_init();

                    //$tophone=$pno1;
                    //$message="A client is requesting your product (order no. $ordername). Please login to MyGas app to accept the order";

                    //$CallBackURL = 'https://tumefika.co.ke/admin/callback_url.php';
                    $curl_post_data = array('username' => 'yoosinpaddy', 'api_key' => 'h8f3OgwEVI1t7365C7p55nTJttuEkFDyQNydRMlSG9CBQ8ZF1Q', 'sender' => 'SMARTLINK', 'to' => $request->phone, 'message' => 'Your Password reset is ' . $password, 'msgtype' => '5', 'dlr' => 'success');
                    $data_string = json_encode($curl_post_data);

                    curl_setopt($curl, CURLOPT_URL, 'https://sms.movesms.co.ke/api/compose');

                    curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-type: application/json", "ApiKey:109dfaa303aa452092a65361e9b4e8d6"]);

                    // curl_setopt($curl, CURLOPT_HEADER, false);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

                    //$curl_response = curl_exec($curl);
                    //echo 'exercuting curl';
                    curl_exec($curl);
                }
                return response([
                    'error' => false,
                    'message' => 'Password reset message bsent',

                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => true,
                    'message' => 'Failed to send message!',
                ], Response::HTTP_OK);
            }
        }
        // }

    }

    public function token_connfrm(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'token' => 'required',
        ];
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response(['errors' => $error->errors()->all()], Response::HTTP_OK);
        } else {
            $status = PasswordReseting::where('email', $request->email)->where('token', $request->token)->count();
            if ($status > 0) {
                return response([
                    'error' => false,
                    'message' => 'Password reset token validated',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => true,
                    'message' => 'Password reset token invalid!',
                ], Response::HTTP_OK);
            }
        }
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response(['errors' => $error->errors()->all()], Response::HTTP_OK);
        } else {
            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->password);
            if ($user->update()) {
                return response([
                    'error' => false,
                    'message' => 'Password updated successfuly!',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => true,
                    'message' => 'Password failed to update!',
                ], Response::HTTP_OK);
            }
        }
    }


    public function generateUniqueFileName($image, $destinationPath)
    {
        $initial = "waps_";
        $name = $initial . Str::random() . time() . '.' . $image->getClientOriginalExtension();
        if ($image->move(public_path() . $destinationPath, $name)) {
            return $name;
        } else {
            return null;
        }
    }
}
