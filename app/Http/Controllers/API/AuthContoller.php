<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;

class AuthContoller extends Controller
{
    use GeneralTrait;

    public function register(Request $request)
    {

        try {
            $validator = Validator::make(request()->all(), [
                'id' => 'integer|exists:customers,id',
                'name' => 'required|string|max:74',
                'email' => 'required|unique:users,email|email|max:225',
                'phone' => 'required|unique|regex:/^\+(?:[0-9]?){6,14}[0-9]$/',
                'password' => 'required|string|min:6|confirmed',
                'bio' => 'string|max:225',
                'profile_image' => 'stirng|file|mimes:jpeg,png,jpg,gif|max:2048',
                'address' => 'required|string|max:225',
                'area_id' => 'required|integer|sxists:areas,id',
            ]);
            if ($validator->fails()) {
                return $this->requiedFiled($validator->errors()->first());
            } else {
                $user = User::create([
                    'id' => $validator['id'],
                    'name' => $validator['name'],
                    'email' => $validator['email'],
                    'phone' => $validator['phone'],
                    'password' => Hash::make($validator['password']),
                    'bio' => $validator['password'],
                    'profile_image' => $validator['profile_image'],
                    'address' => $validator['address'],
                    'area_id' => $validator['area_id']
                ]);
                $token = $user->createToken('api-token')->plainTextToken;
                return response()->json([
                    'user' => $user,
                    'token' => $token
                ], 201);
            }
        } catch (\Throwable $th) {
            return $this->errorResponse('An unexpected error occurred', $th->getMessage());
        }
    }
}
