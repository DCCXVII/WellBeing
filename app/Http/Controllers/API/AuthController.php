<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
        $role = Role::findByName('client');
        $user->assignRole($role);
        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            /* if ($user->hasRole('instructor') && !$user->password_changed) {
                // Instruct the instructor to change their password
                return response()->json([
                    'change_password_required' => true,
                    'message' => 'You are required to change your password.',
                ], 200);}*/

            $success['token'] =  $user->createToken('MyApp')->plainTextToken;

            $success['name'] =  $user->name;
            $success['email'] = $user->email;
            $success['image'] = $user->img_url;
            $success['role'] = $user->roles->first()->name;
            $success['csrf_token'] = csrf_token();


            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
        throw ValidationException::withMessages([
            'email' => 'Invalid credentials',
        ]);
    }

    // public function login(Request $request)
    // {
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         $user = Auth::user();
    //         $roles = $user->roles()->pluck('name'); // Retrieve the roles associated with the user
    //         $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    //         $success['user'] =  $user;
    //         $success['role'] =  $roles;

    //         return $this->sendResponse($success, 'User login successfully.');
    //     } else {
    //         return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    //     }
    //     throw ValidationException::withMessages([
    //         'email' => 'Invalid credentials',
    //     ]);
    // }




    public function changePassword(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        // Check if the current password matches the user's password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 401);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }
}
