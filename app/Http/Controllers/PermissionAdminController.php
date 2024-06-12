<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionAdminController extends Controller
{
    public function permissionCreate()
    {
        return view('admin.permission.add');
    }
    public function permissionStore(Request $request)
    {
        $permission =Permission::create([
            'name'=>ucfirst($request->module_name),
            'display_name'=>ucfirst($request->module_name),
            'parent_id'=>0,
            'key_code'=>''
        ]);

        foreach ($request->module_child as $i){
            Permission::create([
                'name'=>ucfirst($i).' '.ucfirst($permission->name),
                'display_name'=>ucfirst($i).' '.ucfirst($permission->name),
                'parent_id'=>$permission->id,
                'key_code'=>$i.'_'.$request->module_name,
            ]);
        }
        return redirect()->route('permission.creatPermission');
    }
}
