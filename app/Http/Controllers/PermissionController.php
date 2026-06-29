<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Permission::query();

        if ($request->filled('search')) {

            $query->where(
                'name',
                'like',
                '%'.$request->search.'%'
            );

        }

        $permissions = $query
            ->latest()
            ->paginate(20);

        return view(
            'permissions.index',
            compact('permissions')
        );
    }
    public function create()
    {
        return view('permissions.create');
    }
    public function store(Request $request)
    {
        $request->validate([

            'name'=>'required|unique:permissions,name'

        ]);

        Permission::create([

            'name'=>$request->name

        ]);

        return redirect()
            ->route('permissions.index')
            ->with(
                'success',
                'Permission Created Successfully.'
            );
    }
    public function edit(Permission $permission)
    {
        return view(
            'permissions.edit',
            compact('permission')
        );
    }
    public function update(
        Request $request,
        Permission $permission
    )
    {
        $request->validate([

            'name'=>'required|unique:permissions,name,'.$permission->id

        ]);

        $permission->update([

            'name'=>$request->name

        ]);

        return redirect()
            ->route('permissions.index')
            ->with(
                'success',
                'Permission Updated Successfully.'
            );
    }
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with(
            'success',
            'Permission Deleted.'
        );
    }
}
