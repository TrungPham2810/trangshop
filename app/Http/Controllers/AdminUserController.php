<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    protected $user;
    protected $role;
    public function __construct(
        User $user,
        Role $role
    ) {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $data = $this->user->latest()->paginate(10);
        return view('admin.user.list', compact('data'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    public function store(UserAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $rolesId = $request->roles;
            $dataInsert = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ];
            $user = $this->user->create($dataInsert);
            // nếu khai báo relatiónhip của table user ms table roles va role_users thi co the ap dung method nay
            // de tao data cho table role_users
            $user->roles()->attach($rolesId);

            // cach tao data role_users bong thuong
//            foreach ($rolesId as $roleId) {
//                DB::table('role_users')->insert([
//                   'role_id'=> $roleId,
//                    'user_id' => $user->id
//                ]);
//            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        try {
            $user = $this->user->find($id);
            $currentRoles = $user->roles;
            $roles = $this->role->all();
            if ($user->id) {
                return view('admin.user.edit', compact('user', 'roles', 'currentRoles'));
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
            $user = $this->user->find($id);
            if($request->has('new_password') && $request->new_password) {
                if(Hash::check($request->password, $user->password)){
                    $dataUpdate['password'] = bcrypt($request->new_password);
                } else {
                    Log::error('Message: Incorrect current password please enter again.');
                    return redirect()->route('user.edit', ['id'=>$id]);
                }
            }
            $dataUpdate['name'] = $request->name;
            $dataUpdate['email'] = $request->email;
            $this->user->find($id)->update($dataUpdate);
            $user = $this->user->find($id);
            if($user->id) {
                $rolesId = $request->roles;
                $user->roles()->sync($rolesId);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('user.index');
    }

    public function delete($id)
    {
        if($id) {
            try {
                $user = $this->user->find($id);
                $user->delete();
                $message = 'Delete user success.';
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
