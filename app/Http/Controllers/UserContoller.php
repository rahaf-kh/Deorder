<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserContoller extends Controller
{
    use GeneralTrait;

    public function register(Request $request)
    {

        try {
            $validator = Validator::make(request()->all(), [
                'id' => 'integer|exists:customers,id',
                'name' => 'required|string|max:74',
                'email' => 'required|unique:users,email|email|max:225',
                'phone' => 'required|unique:users,phone|regex:/^\+(?:[0-9]?){6,14}[0-9]$/',
                'password' => 'required|string|min:6|confirmed',
                'bio' => 'string|max:225',
                'profile_image' => 'string|file|mimes:jpeg,png,jpg,gif|max:2048',
                'address' => 'required|string|max:225',
                'area_id' => 'required|integer|exists:areas,id',
            ]);
            if ($validator->fails()) {
                return $this->requiedFiled($validator->errors()->first());
            } else {
                $user = User::create([
                    // 'id' => $validator['id'],
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
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'bio' => $user->bio,
                        'address' => $user->address,
                        'area_id' => $user->area_id,
                        'profile_image_url' => asset('image/' . $user->profile_image),
                    ],
                    'token' => $token
                ], 201);
            }
        } catch (\Throwable $th) {
            return $this->errorResponse('An unexpected error occurred', $th->getMessage());
        }
    }
    public function updatePassword(Request $request)
    {
        try {
            $user = auth('sanctum')->user();
            if (!$user) {
                return $this->unAuthorizeResponse();
            } else {
                $validator = Validator::make($request->all(), [
                    'old_password' => 'required',
                    'new_password' => 'required|confirmed|different:old_password',
                    'new_password_confirmation' => 'required'
                ]);
                if ($validator->fails()) {
                    return $this->requiredField($validator->errors()->first());
                }
                if (!Hash::check($request->old_password, Auth::user()->password)) {
                    return $this->errorResponse($request, 'Old password does not match');
                }
                Auth::user()->id->update([
                    'password' => Hash::make($request->new_password)
                ]);
                return $this->successResponse('Password updated successfully');
            }
        } catch (\Throwable $th) {
            return $this->requiredField('An error occurred while fetching data :', $th->getMessage());
        }
    }
    public function StoreImage(Request $request)
    {
        try {
            $user = auth('sanctum')->user();
            if (!$user) {
                return $this->unAuthorizeResponse();
            } else {
                $validator = Validator::make($request->all(), [
                    'image' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048'
                ]);
                if ($validator->fails()) {
                    return $this->requiredField($validator->errors()->first());
                }

                $oldImage = User::findOrFail(Auth::user()->id)->image;
                if ($oldImage) {
                    $imagePath = public_path('image/' . $oldImage);
                }
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('image'), $imageName);
                Auth::user()->id->update(['image' => $imageName]);
                return $this->successResponse('Image updated successfully');
            }
        } catch (\Throwable $th) {
            return $this->requiredField('An error occurred while fetching data :', $th->getMessage());
        }
    }
    public function showProfile($user)
    {
        $user = auth('sanctum')->user();
        if (!$user) {
            return $this->unAuthorizeResponse();
        } else {
            return $this->successResponse([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'bio' => $user->bio,
                'address' => $user->address,
                'area_id' => $user->area_id,
                'profile_image_url' => asset('image/' . $user->profile_image),
            ], 'User profile fetched successfully');
        }
    }
    public function updateProfile(Request $request)
    {
        try {
            $user = auth('sanctum')->user();
            if (!$user) {
                return $this->unAuthorizeResponse();
            } else {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string',
                    'email' => 'required|email',
                    'phone' => 'required|string|regex:/^[0-9]{9,}$/',
                    'area_id' => 'required|integer|exists:areas,id',
                    'address' => 'required|string|max:75',
                    'bio' => 'string|max:120',
                ]);
                if ($validator->fails()) {
                    return $this->requiredField($validator->errors()->first());
                }
                return $this->successResponse($user, 'User profile fetched successfully');
                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'area_id' => $request->area_id,
                    'address' => $request->address,
                    'bio' => $request->bio
                ];
                Auth::user()->id->update($data);
                return $this->successResponse('Data updated successfully');
            }
        } catch (\Throwable $th) {
            return $this->requiredField('An error occurred while fetching data :', $th->getMessage());
        }
    }
    public function destroy()
    {
        try {
            $user = auth('sanctum')->user();
            if (!$user) {
                return $this->unAuthorizeResponse();
            } else {
                Auth::user()->id->delete();
                return $this->successResponse('Profile deleted successfully');
            }
        } catch (\Throwable $th) {
            return $this->requiredField('An error occurred while fetching data :', $th->getMessage());
        }
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->successResponse('Logged out successfully');
    }
}
