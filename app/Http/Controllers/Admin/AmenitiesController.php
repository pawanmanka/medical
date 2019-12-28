<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Category;
use App\Traits\DatatableGrid;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    use DatatableGrid;
    
    public function __construct()
    {
        $this->data['menu'] = 'amenities';
    }

    public function index(){
        $this->data['subMenu'] = 'amenities_list';
        return view('admin.amenities_list',$this->data);
    }

    public function add(Request $request){
        $this->data['subMenu'] = 'amenities_add';
        return view('admin.amenities_add_edit',$this->data);       
    }



    public function edit(Request $request){
        $amenitiesObj = Amenities::find($request->id);
        $this->data['subMenu'] = 'amenities_add';
        $this->data['amenities'] = $amenitiesObj;
        return view('admin.amenities_add_edit',$this->data);       
    }

    public function save(Request $request){
        $id = $request->id;
        $rules = array(
            'name'=>'required'
        );
      
        $validation = \Validator::make($request->all(),$rules);
        if($validation->fails()){
          
             flash(makeErrorMessage($validation->errors()->messages()))->error()->important();
             return back()->withInput(); 
        }
        else{
            $amenitiesObj = !empty($id)?Amenities::find($id):new Amenities();
            $amenitiesObj->name = $request->name;
            $amenitiesObj->parent_id = !empty($request->parent_id)?$request->parent_id:0;
            $amenitiesObj->super_amenities_id = !empty($request->super_amenities_id)?$request->super_amenities_id:0;
            $amenitiesObj->slug = $amenitiesObj->createSlug($request->name,$id);
            if($request->hasFile('image')) {
                $amenitiesObj->image =   $this->fileUpload($request,config('application.amenities_image_path'));
            }
            $amenitiesObj->save();
            flash('amenities Save Successfully')->success()->important();
            return redirect('/administrator/amenities/list');
        }
    }

    public function grid(Request $request){
        $fields = array(
            "id",
            "name",	
            "slug"	
          );
    	$this->columns =$fields;
        $this->searchColumns =$fields;
    	$this->setOrderBy();  	
    	$this->setSearchCondition();
    	
        $this->query = Amenities::where('id','!=',0);        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $editLink = url("administrator/amenities/edit/$row->id");
                $action ='';
                if(auth()->user()->can('edit amenities')){
                $action .= "<a href='$editLink' class='btn btn-primary text-white'><i class='fa fa-pencil'></i></a> ";
                }
               if(auth()->user()->can('delete amenities')){
                $action .= "<a data_id='$row->id' href='#' class='btn btn-danger deleteCategory text-white'><i class='fa fa-trash'></i></a>";
                }
                $output ['data'] [] = array (
	    			$row->id,
	    			$row->name,
	    			$row->slug,
	    			$action
	    		);
	    	}
        }
        


        return response()->json($output);  
    }
    

    public function delete(Request $request)
    {
        $status = self::$ERROR;
        $message = 'amenities not found';
        
        $amenitiesObj = Amenities::find($request->id);
        if(isset($amenitiesObj->id)){
            $subCategoryObj = Amenities::whereParentId($amenitiesObj->id)->first();
            if(empty($subCategoryObj->id)){
                $amenitiesObj->delete();
                $status = self::$SUCCESS;
                $message = "amenities Deleted Successfully";
            }
            else{
                $message = "amenities have subcategories ";
            }
        }
        

        $result = array(
            'status'=>$status,
            'message'=>$message
        );

        return response()->json($result);
    }
}
