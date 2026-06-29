<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        $query = User::where('tenant_id', $tenantId);

        //
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");

            });

        }
//check
        $users = $query
            ->latest()
            ->paginate(10);

        return view(
            'users.index',
            compact('users')
        );
    }


    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view(
            'users.create',
            compact('roles')
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'nullable|string|max:20',
            'password'  => ['required','confirmed',Password::defaults()],
            'role'      => 'required',
            'status'    => 'required|boolean',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $avatar = null;

        if ($request->hasFile('avatar')) {

            $avatar = $request
                ->file('avatar')
                ->store('avatars','public');

        }

        $user = User::create([

            'tenant_id'      => auth()->user()->tenant_id,

            'name'           => $request->name,

            'email'          => $request->email,

            'phone'          => $request->phone,

            'password'       => Hash::make($request->password),

            'avatar'         => $avatar,

            'status'         => $request->status,

            'last_login_at'  => null,

        ]);

        $user->assignRole($request->role);

        return redirect()
            ->route('users.index')
            ->with('success','User Created Successfully.');
    }


    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();

        return view(
            'users.edit',
            compact('user', 'roles')
        );
    }


    public function update(Request $request, User $user)
    {
        $request->validate([

            'name'      => 'required|string|max:255',

            'email'     => 'required|email|unique:users,email,'.$user->id,

            'phone'     => 'nullable|string|max:20',

            'role'      => 'required',

            'status'    => 'required|boolean',

            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'password'  => ['nullable','confirmed',Password::defaults()],

        ]);

        if ($request->hasFile('avatar')) {

            $avatar = $request
                ->file('avatar')
                ->store('avatars','public');

            $user->avatar = $avatar;

        }

        $user->name = $request->name;

        $user->email = $request->email;

        $user->phone = $request->phone;

        $user->status = $request->status;

        if ($request->filled('password')) {

            $user->password = Hash::make($request->password);

        }

        $user->save();

        $user->syncRoles([$request->role]);

        return redirect()
            ->route('users.index')
            ->with('success','User Updated Successfully.');
    }


    public function destroy(User $user)
    {
        if ($user->id == auth()->id()) {

            return back()->with(

                'error',

                'You cannot delete your own account.'

            );

        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success','User Deleted Successfully.');
    }
}
