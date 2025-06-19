<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
 public function store(Request $request): JsonResponse
 {
  $request->validate([
   'email'    => ['required', 'email'],
   'password' => ['required'],
  ]);

  $user = User::where('email', $request->email)->first();

  if (! $user || ! Hash::check($request->password, $user->password)) {
   return response()->json([
    'message' => 'Invalid credentials',
   ], 401);
  }

  return response()->json([
   'message' => 'Login successful',
   'token'   => $user->createToken('auth_token')->plainTextToken,
  ]);
 }

 public function destroy(Request $request): JsonResponse
 {
  $request->user()->currentAccessToken()->delete();

  return response()->json([
   'message' => 'Logged out',
  ]);
 }
}
