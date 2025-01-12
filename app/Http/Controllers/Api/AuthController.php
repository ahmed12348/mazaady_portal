<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;  // Importing the JWTAuth facade

class AuthController extends Controller
{
    // Register Method - Register a new user
    public function register(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',  // 'confirmed' requires password_confirmation in the request
        ]);

        // Create user record
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Return success response
        return response()->json([
            'message' => 'User created successfully!',
            'user' => $user
        ], 201);
    }

    // Login Method - Authenticate and issue a JWT token
    public function login(Request $request)
    {
        // Validate incoming request data
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate and generate JWT token
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401); // Return error if credentials are invalid
        }

        // Return the generated token
        return response()->json([
            'success' => true,
            'data'    => ['token' => $token],
            'message' => 'Login successful.',
        ]);
    }

    // Logout Method - Invalidate the user's JWT token
    public function logout(Request $request)
    {
        try {
            // Invalidate the user's token to log them out
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'message' => 'Logged out successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to logout, please try again.',
            ], 500);
        }
    }

    // Optional: Get User's Profile (using JWT Authentication)
    public function userProfile(Request $request)
    {
        // You can access the authenticated user with JWTAuth::user()
        $user = JWTAuth::user();

        return response()->json([
            'user' => $user
        ]);
    }
}
