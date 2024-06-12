<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserAdminController extends Controller
{
    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $users = $this->user->latest()->paginate(6)->fragment('users');
        return view('admin.user.index', compact('users'));
    }

    public function creat()
    {
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    public function store(UserAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)]);

            $user->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage() . '---Line: ' . $exception->getLine());
        }

    }

    public function edit($id)
    {
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $roleOfUser = $user->roles;
        return view('admin.user.edit', compact('roles', 'user', 'roleOfUser'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
             $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user =$this->user->find($id);
            $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage() . '---Line: ' . $exception->getLine());
        }
    }
    public function delete($id)
    {
        try {
            $this->user->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Delete success'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Error ' . $exception->getMessage() . ' --Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Delete fail'
            ], 500);
        }
    }
}
