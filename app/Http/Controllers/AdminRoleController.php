<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class AdminRoleController extends Controller
{
    protected $role;
    protected $permission;
    public function __construct(
        Role $role,
        Permission $permission
    ) {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $data = $this->role->latest()->paginate(10);
        return view('admin.role.list', compact('data'));
    }

    public function create()
    {
        $permission = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('permission'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataInsert = [
                'name' => $request->name,
                'display_name' => $request->display_name,
            ];
            $role = $this->role->create($dataInsert);
            if($permissionIds = $request->permission) {
                if($permissionIds[0] == null) {
                    unset($permissionIds[0]);
                }
                $role->permissions()->attach($permissionIds);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('role.index');
    }

    public function edit($id)
    {
        try {
            $role = $this->role->find($id);
            $currentPermission = $role->permissions;
            $permissions = $this->permission->where('parent_id', 0)->get();
            if ($role->id) {
                return view('admin.role.edit', compact('role', 'permissions', 'currentPermission'));
            }
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('user.index');
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $dataUpdate = [];
            $dataUpdate['name'] = $request->name;
            $dataUpdate['display_name'] = $request->display_name;
            $this->role->find($id)->update($dataUpdate);
            $role = $this->role->find($id);
            if($role->id) {
                $permissionIds = $request->permission;
                if($permissionIds[0] == null) {
                    unset($permissionIds[0]);
                }
                $role->permissions()->sync($permissionIds);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('role.index');
    }

    public function delete($id)
    {
        if($id) {
            try {
                $role = $this->role->find($id);
                $role->delete();
                $message = 'Delete role success.';
                return response()->json([
                    'code' =>200,
                    'message' => $message
                ], 200);
            } catch (\Exception $e) {
                $message = 'Error: '.$e->getMessage();
                return response()->json([
                    'code' =>500,
                    'message' => $message
                ]);
            }
        } else {
            $message = 'Error: Can\'t found slider to delete ';
            return response()->json([
                'code' =>500,
                'message' => $message
            ]);
        }
    }


}
