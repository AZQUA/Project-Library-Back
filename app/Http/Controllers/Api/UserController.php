<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
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
        $token = $user->createToken('validation_token');
        return [
            "data"=>[$user, $token]
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return [
            'data'=>$request->user()
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $currentUser = $request->user();
        $user = User::find($id);
        if (!$user || $id != $currentUser->$id) {
            throw new UnauthorizedException("Cet identifiant est inexistant ou vous n'avez pas les droits nécéssaire");
        }
        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return $user->delete();
    }

    public function logout(Request $request){
        return [
            "data" => $request->user()->currentAccessToken()->delete()
        ];
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
        $token=$user->createToken("access_token", ['*'], now()->plus(years: 1));
        return [
            "data"=>$token->plainTextToken
        ];
    }

    public function validate(Request $request){
        $request->user()->email_verified_at = now();
        $request->user()->save();
        $request->user()->currentAccessToken()->delete();
        return [
            "data"=>$request->user()
        ];
    }
}
