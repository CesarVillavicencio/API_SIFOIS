<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\Recover;
use App\Http\Requests\Admin\Auth\Reset;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthPasswordController extends Controller {
    public function passwordRecover(Recover $request) {
        // Check Blocked User
        $user = AdminUser::where('email', $request->email)->first();
        if ($this->isUserBlockedAndExist($user)) {
            return response()->json($this->getBlockedErrorResponse($user->blocked_at), 403);
        }

        $status = Password::broker('admin_users')
        ->sendResetLink($request->only('email'));

        switch ($status) {
            case Password::RESET_LINK_SENT:
                return response()->json([
                    'status' => trans($status),
                ], 200);
            case Password::INVALID_USER:
                return response()->json([
                    'message' => trans('passwords.user'),
                    'errors' => ['email' => [trans('passwords.user')]],
                    'error_name' => 'invalid_user',
                ], 422);
        }
    }

    public function passwordReset(Reset $request) {
        $status = Password::broker('admin_users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                // event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? response()->json(['status' => trans($status)])
            : response()->json([
                'message' => trans($status),
                'errors' => ['email' => [trans($status)]],
                'error_name' => 'password_reset_error',
            ], 422);
    }

    protected function getBlockedErrorResponse($blocked_at) {
        return [
            'server_unauthorized' => true,
            'server_error_reason' => 'blocked admin user',
            'blocked_at' => $blocked_at,
        ];
    }

    protected function isUserBlockedAndExist($user) {
        if ($user != null) {
            return $user->isBlocked();
        } else {
            return false;
        }
    }
}
