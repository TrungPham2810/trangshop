<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class AdminPermissionController extends Controller
{
    protected $permission;

    public  function __construct(
        Permission $permission
    ) {
        $this->permission = $permission;
    }
    public function create()
    {
        return view('admin.permission.add');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $permission = Permission::create([
                'name'=> $request->module_name,
                'key_code'=> $request->module_name,
                'display_name'=> ucwords($request->module_name),
                'parent_id'=>0,
            ]);
            foreach ($request->action as $action) {
                $this->permission->create([
                    'name'=> $action.'_'.$request->module_name,
                    'display_name'=> ucwords($action.' '.$request->module_name),
                    'parent_id' => $permission->id,
                    'key_code' => $action.'_'.$request->module_name
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('permission.index');
    }
}
