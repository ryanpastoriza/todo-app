<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
// use App\Traits\JsonResponseWithStatus;

class AuthenticateUserController extends Controller
{
    // use JsonResponseWithStatus;

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
    	
        $request->authenticate();
        // $request->session()->regenerate();
        
        return response()->json([ 
            'user' => $request->user(),
            'token' => $request->user()->createToken('api-token')->plainTextToken
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        if (Auth::user()) {
            // $request->user()->tokens()->delete();
            $request->user()->currentAccessToken()->delete();
        }

       return response()->json(null, JsonResponse::HTTP_NO_CONTENT);

    } 
}
