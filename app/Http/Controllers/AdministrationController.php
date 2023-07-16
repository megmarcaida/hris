<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;


class AdministrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('administration/change_password');
    }

    public function role()
    {
        $roles = Role::all();

        return view('administration/role/role')->with(['roles'=>$roles,'message'=>'']);
    }

    public function addRole(Request $request)
    {
        $message = "";
        if($request->post()){
            $roles = new Role();
            $roles->name = $request->post('name');
            $roles->save();
            if($roles){
                $message = "Successfully saved.";
            }else{
                $message = "Failed to save";
            }
        }
        return view('administration/role/add-role')->with('success',$message);
    }

    public function editRole(Request $request, $id = 0)
    {
        $message = "";
        $id = $request->post('id') ?: $id;
        $roles = Role::find($id);
        if($roles) {
            if($request->post()){
                $roles->name = $request->post('name');
                $permissions = '';
                    foreach($request->post('permissions') as $k => $v){
                        if($k == 0){
                            $permissions .= $v;
                        } else {
                            $permissions .= "," . $v; 
                        }
                    }
                $roles->permissions = $permissions;
                $roles->save();
                if($roles){
                    $message = "Successfully saved.";
                }else{
                    $message = "Failed to save";
                }
            }

            return view('administration/role/edit-role')->with(['success'=>$message,'role'=>$roles]);
        }

        return redirect()->route('adm/roles'); 
    }

    public function deleteRole($id)
    {
        $role = Role::where('id',$id);
        $checkIfExist = User::where('role_id',$id)->count();
        $message = null;
        $error = null;
        if($checkIfExist == 0){
            $role->delete();
            $message = "Successfully delete.";
        }else{
            $error = "Cannot delete, role is currently used.";
        }
        
        return back()->with(["success" => $message, "error"=>$error]);
    }

    public function permissions()
    {
        return view('administration/permissions');
    }
}
