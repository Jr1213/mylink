<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\createAccountRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class authController extends Controller
{
    public function create(createAccountRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $user->createToken('APITOKEN')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'user has been created'
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                'line' => $e->getLine(),
                'message' => $e->getMessage(),
                'success' => false
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
