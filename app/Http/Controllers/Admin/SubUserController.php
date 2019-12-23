<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Traits\DatatableGrid;
use Illuminate\Http\Request;

class SubUserController extends UserCommonController{

    use DatatableGrid;
    
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = 'Sub Admin';
        $this->data['pageView'] = 'admin.sub_admin';
    } 



    public function index(Request $request)
    {
        return view($this->data['pageView'].'_list',$this->data);
    }

    public function grid(Request $request){
        $fields = array(
            "id",
            "name",	
            "email"	
          );
    	$this->columns =$fields;
        $this->searchColumns =$fields;
    	$this->setOrderBy();  	
    	$this->setSearchCondition();
    	
        $this->query = User::whereHas('roles',function($query){
            $query->whereIn('name',array(config('application.subadmin_role')));
        });        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $editLink = url("administrator/permission_management/edit/$row->id");
                $action ='';
                if(auth()->user()->can('edit subadmin')){
                    $action = "<a href='$editLink' class='btn btn-primary text-white'><i class='fa fa-pencil'></i></a> ";
                }
                 if(auth()->user()->can('edit subadmin')){
                    $action .= "<a data_id='$row->id' href='#' class='btn btn-danger deleteUser text-white'><i class='fa fa-trash'></i></a>";
                }
                
                $output ['data'] [] = array (
	    			$row->id,
	    			$row->name,
	    			$row->email,
	    			$action
	    		);
	    	}
        }
        


        return response()->json($output);  
    }
    
    public function add(Request $request){
        $this->data['subMenu'] = $this->data['menu'].'_add';
       
        return view($this->data['pageView'].'_add_edit',$this->data);       
    }

    private function _roleArr(){
        $this->data['roleArr'] = Role::whereIn('name',
        array(config('application.hospital_subadmin_role'),
        config('application.doctor_subadmin_role'),
        config('application.lab_subadmin_role')
        ))->pluck('name','id')->toArray();

    }

    public function edit(Request $request){
        $UserObj = User::with('roles')->find($request->id);
       
     
        foreach ($UserObj->roles as $key => $value) {
           
                $UserObj->role_id=$value->id;
            
        }
      
        $this->data['subMenu'] = $this->data['menu'].'_add';
        $this->data['user'] = $UserObj;
        $this->data['permissions'] = array_flip($UserObj->getPermissionNames()->toArray());
        
        return view($this->data['pageView'].'_add_edit',$this->data);       
    }

    public function save(Request $request){
        $id = $request->id;
        $rules = array(
            'permission.*'=>'required',
            'name'=>'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
        );

        if(!empty($request->password)){
         //   $rules['password']  =  ['required', 'string', 'min:8', 'confirmed'];
        }
      
        $validation = \Validator::make($request->all(),$rules);
        if($validation->fails()){
       
             flash(makeErrorMessage($validation->errors()->messages()))->error()->important();
             return back()->withInput(); 
        }
        else{
            $permission = $request->permission;
            $permissionArr= array();
            foreach ($permission as $key => $value) {
             foreach ($value as $index => $each) {
                $permissionArr[] = "$index $key";
             }
            }
          
            $userObj = !empty($id)?User::find($id):new User();
            $userObj->name = $request->name;
            $userObj->email = $request->email;
            if(!empty($request->password)){
             $userObj->password = bcrypt($request->password);
            }
            $userObj->save();
      
            $role_r = Role::where('name', '=','subadmin')->firstOrFail();            
            $userObj->assignRole($role_r);


            $userObj->syncPermissions($permissionArr);


            flash('User Save Successfully')->success()->important();
            return redirect('/administrator/'.$this->data['current_segment'].'/list');
        }
    }

    public function delete(Request $request)
    {
        $status = self::$ERROR;
        $message = 'User not found';
        
        $UserObj = User::whereHas('roles',function($query){
            $query->whereIn('name',
        array(config('application.hospital_subadmin_role'),
        config('application.doctor_subadmin_role'),
        config('application.lab_subadmin_role')
        ));
        })->find($request->id);
        if(isset($UserObj->id)){
            $UserObj->delete();
            $status = self::$SUCCESS;
            $message = "User Deleted Successfully";
        }
        

        $result = array(
            'status'=>$status,
            'message'=>$message
        );

        return response()->json($result);
    }


}