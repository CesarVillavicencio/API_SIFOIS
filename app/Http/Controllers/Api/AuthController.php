<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\Login;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function login(Login $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return response()->json($this->getErrorResponse(), 401);
        }

        if (! Hash::check($request->password, $user->password)) {
            return response()->json($this->getErrorResponse(), 401);
        }

        if ($user->isBlocked()) {
            return response()->json($this->getBlockedErrorResponse($user->blocked_at), 403);
        }

        $token = $user->createToken('APIAccess');

        return response()->json($this->getLogData($user, $token));

    }

    protected function getErrorResponse() {
        return ['errors' => ['email' => [trans('auth.failed')]]];
    }

    protected function getBlockedErrorResponse($blocked_at) {
        return [
            'server_unauthorized' => true,
            'server_error_reason' => 'blocked admin user',
            'blocked_at' => $blocked_at,
        ];
    }


    public function register(Request $request)
    {
        // Create New User
        $user = User::create([
            'name'       => $request->name,
            'lastname'   => $request->lastname,
            'email'      => $request->email,
            'avatar'     => env('DEFAULT_AVATAR_URL', ''),
            'password'   => bcrypt($request->password),
            'phone'      => $request->phone,
            'type'       => 'builder',
            'location'   => $request->location
        ]);

        // Create Configuration Record & Set User Prefered Language
        // UserConfiguration::create($this->getDefaultUserConfiguration($user->id, $request->header('app_language', 'es')));

        // Create Token
        $token = $user->createToken('APIAccess');
 
        return response()->json($this->getLogData($user, $token));
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        
        return response()->json(['success' => true]);
    }

    // AFTER LOGIN FUNCTION
    public function getUserCheck(Request $request) {
        return response()->json(['user' => $request->user()]);
    }
    
    public function getUser(Request $request) {
        return response()->json($this->getLogData($request->user()));
    }

    public function loginAsRandomUser()
    {
        $user = User::whereNull('blocked_at')->inRandomOrder()->first();
        if (isset($user)) {
            $token = $user->createToken('APIAccess');
            return response()->json($this->getLogData($user, $token));
        } else {
            return response()->json($this->getErrorResponse(), 401);
        }
    }

    protected function getLogData(User $user, $token = null) {
        $data = [
            'user' => $user
        ];

        if ($token != null) {
            $data['token'] = $token->accessToken;
        }

        return $data;
    }

    protected function test(){
        // dd('hola');
        $users = User::all()->take(10);
        return $users;
        // dd($users);
    }
}
