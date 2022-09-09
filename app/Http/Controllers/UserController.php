<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:25',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|max:25|regex:/[#$%^&*()+=!?¿.,:;]/i',
                    'company' => 'required|boolean'
                ]
            );

            if ($validator->fails()) {
                return response()->json(

                    [
                        'success' => false,
                        'message' => $validator->errors()
                    ],
                    400 
                );
            }

            $user = User::create(
                [
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'password' => bcrypt($request->password),
                    'company' => $request->get('company')
                ]

            );
            return response()->json(
                [
                    'success' => true,
                    'message' => 'User Created',
                    'data' => $user
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error('Error to create user' . $exception->getMessage());
            return response()->json(
                [
                    'seccess' => false,
                    'message' => ' Error to create new User'
                ],
                404
            );
        }
    }

    public function login(Request $request)
    {

        $input = $request->only('email', 'password');
        $jwt_token  = JWTAuth::attempt($input);

        if ($jwt_token === null) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Invalid Registers username or password'
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }
        return response()->json(
            [
                'success' => true,
                'token' => $jwt_token,
            ]
        );
    }

    public function logout(Request $request)
    {
        try {
            $this->validate(
                $request,
                [
                    'token' => 'require'
                ]
            );

            JWTAuth::invalidate($request->token);
            return response()->json(
                [
                    'success' => true,
                    'token' => 'You have successfully logout'
                ]
            );
        } catch (\Exception $exception) {
            Log::error('Error to log out', $exception);
            return response()->json(
                [
                    'success' => false,
                    'message' => 'You cant logout because you are not logged yet'
                ],
                404
            );
        }
    }

    public function follow($userId){
        try {
            $user = auth()->user();
            $followExist = Follow::query()->where('sender_id', $user->id)->where('target_id', $userId)->get();
            
            if(count($followExist) > 0){
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'User has already followed this user'
                    ],
                    400
                );
            }
                        
            $follow = new Follow();
            $follow->sender_id = $user->id;
            $follow->target_id = $userId;
            $follow->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'User has followed this user'
                ],
                200
            );

        } catch (\Exception $exception){
            Log::error('Error to follow this user'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to follow this user'                             
                ],
               404
            );
        }
    }

    public function getFollows($userId){
        try {
            $follows = Follow::query()->where('target_id', $userId)->get();
            $numberFollows = count($follows);
           
            return response()->json(
                [
                    'success' => true,
                    'message' => 'All follows from this user',
                    'count' => $numberFollows,
                ],
                200
            );

        } catch (\Exception $exception){
            Log::error('Error to get follows'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to get follows'                             
                ],
               404
            );
        }
    }

    public function deleteFollow($userId){
        try {
            $user = auth()->user();
            $followExist = Follow::query()->where('sender_id', $user->id)->where('target_id', $userId)->get();

            if(count($followExist) == 0){
               return response()->json(
                    [
                        'success' => false,
                        'message' => 'No follows found'
                    ],
                    404
                );
            }

            $followId = $followExist[0]->id;
            Follow::query()->find($followId)->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'follow deleted'
                ],
                200
            );
            
        }catch (\Exception $exception){
            Log::error('Error to remove follow'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to remove follow'                             
                ],
               404
            );
        }
    }

    public function getByNum($num){
        try {
            $users = User::all()->where('admin', '0')->where('company','0')->take($num);
            
        return response()->json(
            [
                'success' => true,
                'message' => 'you can get this number of users',
                'data' => $users
            ],
            200
        );

        }catch (\Exception $exception){
            Log::error('Error getting users'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to get users by num'                             
                ],
               404
            );
        }
    }
}