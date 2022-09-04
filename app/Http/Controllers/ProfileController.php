<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile($id){
        $user = User::find($id);    
        $me = auth()->user();

        //VER TU PROPIO PROFILE
        if($user->id  == $me->id){
            return response()->json(
                [
                    "success" => true,
                    "data" => $me
                ],
                200
            );
        }

        //VER PROFILE AJENOS
        return response()->json(
            [
                "success" => true,
                "data" => (
                    [
                    "name" => $user->name ,
                    "email" => $user->email
                    ]
                )               
            ],
            200
        );
    }

    public function update(Request $request, $id){
        try {
            $user = User::query()->find($id);               
            $me = auth()->user();

            if($user->id != $me->id){
                return response()->json(
                    [
                        "success" => false,
                        "message" => "you only can update yourself"
                    ],
                    400
                );
            }

            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');

            if(isset($name)){
                $user->name = $name;               
            };

            if(isset($email)){
                $user->email = $email;               
            };

            if(isset($password)){
                $user->password = bcrypt($password);               
            };

            $user->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'you have modifcate your profile successfully',
                    'name' => $name,
                    'email' => $email
                ],
            200
            );

        }catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'You cant modify you profile'
                ],
            404
            );
        }
    }
}
