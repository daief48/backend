<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
  

    public function register(Request $request)
    {
        Log::info('Register request received', [
            'payload' => $request->except(['password', 'password_confirmation']),
        ]);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);

            Log::info('Register validation passed', [
                'email' => $validated['email'],
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            Log::info('User created successfully', [
                'user_id' => $user->id,
            ]);

            $token = auth()->login($user);

            if (! $token) {
                Log::error('JWT token generation failed', [
                    'user_id' => $user->id,
                ]);

                return response()->json([
                    'message' => 'Token generation failed'
                ], 500);
            }

            Log::info('JWT token generated successfully', [
                'user_id' => $user->id,
            ]);

            return response()->json([
                'message' => 'User registered successfully',
                'token'   => $token,
                'user'    => $user,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {

            Log::warning('Register validation error', [
                'errors' => $e->errors(),
            ]);

            throw $e;
        } catch (\Throwable $e) {

            Log::error('Register failed with exception', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            return response()->json([
                'message' => 'Registration failed',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'token' => $token,
            'user'  => auth()->user(),
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
