<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return [
            "data"=>$user
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->json('name');
        $user->email = $request->json('email');
        $user->password = $request->json('password');
        $user->password = $request->json('email_verified_at');
        $user->password = $request->json('phone_number');
        $user->password = $request->json('status');
        $user->password = $request->json('role');
        $user->password = $request->json('library_id');
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return $user->delete();
    }

    public function login(Request $request)
    {
        $users = User::where('email', $request->json('email'))->get();
        if ($users->count() == 0) {
            throw ValidationException::withMessages([
                'email'=> ['The provided credentials are incorrect.'],
            ]);
        }
        $user = $users[0];
        if (!$user->email_verified_at || !Hash::check($request->json('password'),$user->password)) {
            throw ValidationException::withMessages([
                'email'=> ['The provided credentials are incorrect.'],
            ]);
        }
        $token=$user->createToken("access_token");
        return [
            "data"=>$token->plainTextToken
        ];
    }
}
