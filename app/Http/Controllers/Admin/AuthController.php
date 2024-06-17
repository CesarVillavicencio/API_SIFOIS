<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\Login;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin\Configuration;
use App\Models\AdminUser;
use Hash;

class AuthController extends Controller {
    public function login(Login $request) {
        $user = AdminUser::where('email', $request->email)->first();

        if (! $user) {
            return response()->json($this->getErrorResponse(), 401);
        }

        if (! Hash::check($request->password, $user->password)) {
            return response()->json($this->getErrorResponse(), 401);
        }

        if ($user->isBlocked()) {
            return response()->json($this->getBlockedErrorResponse($user->blocked_at), 403);
        }

        $token = $user->createToken('AdminAPIAccess');

        $this->saveSessionData($user, $request);

        return response()->json($this->getLogData($user, $token));
    }

    protected function getErrorResponse() {
        return ['errors' => ['email' => [trans('auth.failed')]]];
    }

    protected function getBlockedErrorResponse($blocked_at) {
        return [
            'server_unauthorized' => true,
            'server_error_reason' => 'blocked admin user',
            'blocked_at'          => $blocked_at,
        ];
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        $request->session()->flush(); // Clear all session data

        return response()->json(['success' => true]);
    }

    public function getUserCheck(Request $request) {
        return response()->json(['user' => $request->user()]);
    }

    public function getUser(Request $request) {
        
        return response()->json($this->getLogData($request->user()));
    }

    protected function getOptions() {
        return Configuration::first()->options;
    }

    public function loginAsRandomAdminUser() {
        $user = AdminUser::whereNull('blocked_at')->inRandomOrder()->first();
        if (isset($user)) {
            $token = $user->createToken('AdminAPIAccess');
            return response()->json($this->getLogData($user, $token));
        } else {
            return response()->json($this->getErrorResponse(), 401);
        }
    }

    protected function getLogData(AdminUser $user, $token = null) {
        $data = [
            'user'       => $user,
            'options'    => $this->getOptions(),
            'user_types' => config('admin.user_types'),
        ];

        if ($token != null) {
            $data['token'] = $token->plainTextToken;
        }

        return $data;
    }

    public function loginAsRandomAdmin(Request $request) {
        $type = $request->type ?? 'admin';
        $user = AdminUser::whereNull('blocked_at')->where('type', $type)->inRandomOrder()->first();
        $token = $user->createToken('AdminAPIAccess');
        $this->saveSessionData($user, $request);

        return response()->json($this->getLogData($user, $token));
    }

    protected function saveSessionData(AdminUser $user, Request $request): bool {
        $request->session()->put('admin_user_data', Crypt::encryptString(json_encode([
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
            'type'  => $user->type
        ])));
        return true;
    }
}
