<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Image as ImageRequest;
use App\Http\Requests\Admin\Users\Create;
use App\Http\Requests\Admin\Users\Password;
use App\Http\Requests\Admin\Users\Update;
use App\Models\AdminUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UsersController extends Controller {
    protected $defaultAvatar = 'users/avatars/pug.png';

    public function getUsers(Request $request) {
        $selected = $request->selected;
        $search = $request->search;
        $sort_field = $request->sort_field ?? 'created_at';
        $order = $request->order ?? 'desc';

        $query = AdminUser::query();

        if ($selected == 'name') {
            $query->where('name', 'like', '%'.$search.'%');
        }

        if ($selected == 'lastname') {
            $query->where('lastname', 'like', '%'.$search.'%');
        }

        if ($selected == 'email') {
            $query->where('email', 'like', '%'.$search.'%');
        }

        if ($selected == 'phone') {
            $query->where('phone', 'like', '%'.$search.'%');
        }

        if ($selected == 'type') {
            $query->where('type', 'like', '%'.$search.'%');
        }

        if ($selected == 'blocked_at') {
            if ($search == 1) {
                $query->whereNotNull('blocked_at');
            } else {
                $query->whereNull('blocked_at');
            }
        }

        if ($selected == 'created') {
            $from = Carbon::createFromFormat('Y-m-d', $search[0]);
            $to = Carbon::createFromFormat('Y-m-d', $search[1]);
            $query->whereBetween('created_at', [$from, $to]);
        }

        $users = $query->orderBy($sort_field, $order)->paginate(20);

        return response()->json($users);
    }

    public function getUser(Request $request) {
        $user = AdminUser::findOrFail($request->id);

        return response()->json($user);
    }

    public function createUser(Create $request) {
        $user = AdminUser::create([
            'name'     => $request->name,
            'lastname' => $request->lastname,
            'email'    => $request->email,
            'type'     => $request->type,
            'avatar'   => $request->avatar ?? $this->defaultAvatar,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user);
    }

    public function updateUser(Update $request) {
        $user = AdminUser::findOrFail($request->id);
        $user->fill([
            'name'     => $request->name,
            'lastname' => $request->lastname,
            'email'    => $request->email,
            'type'     => $request->type,
            'avatar'   => $request->avatar ?? $this->defaultAvatar,
        ]);
        $user->save();

        return response()->json($user);
    }

    public function deleteUser(Request $request) {
        $user = AdminUser::findOrFail($request->id);

        // Same User Delete Validation
        if ($request->user()->id == $user->id) {
            return response()->json([
                'message'    => 'Can not delete yourself',
                'errors'     => ['id' => ['Can not delete yourself']],
                'error_name' => 'same_user_delete',
            ], 422);
        }

        $user->delete();

        return response()->json($user);
    }

    public function uploadAvatar(ImageRequest $request) {
        $file_name = uniqid().'.'.$request->file('image')->getClientOriginalExtension();
        $path = $request->file('image')->storeAs('admin/avatars', $file_name, 'public');

        return response()->json($path);
    }

    public function toggleBlock(Request $request) {
        $user = AdminUser::findOrFail($request->id);
        if ($user->blocked_at == null) {
            $user->blocked_at = Carbon::now();
        } else {
            $user->blocked_at = null;
        }
        $user->save();

        return response()->json($user);
    }

    public function updatePassword(Password $request) {
        $user = AdminUser::findOrFail($request->id);
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json($user);
    }
}
