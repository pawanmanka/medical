<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\DatatableGrid;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use DatatableGrid;
    use UploadImage;
    
    public function __construct()
    {
        $this->data['menu'] = 'category';
    }

    public function index(){
        $this->data['subMenu'] = 'category_list';
        return view('admin.category_list',$this->data);
    }

    public function add(Request $request){
        $this->data['subMenu'] = 'category_add';
        $this->_getParentCategory();
        return view('admin.category_add_edit',$this->data);       
    }


    private function _getParentCategory($currentId = 0){
        $this->data['parentCategory'] = Category::whereParentId(0)->where('id','!=',$currentId)->pluck('name','id');
    }

    public function edit(Request $request){
        $categoryObj = Category::find($request->id);
        $this->_getParentCategory($categoryObj->id);
        $this->data['subMenu'] = 'category_add';
        $this->data['category'] = $categoryObj;
        return view('admin.category_add_edit',$this->data);       
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
            $categoryObj = !empty($id)?Category::find($id):new Category();
            $categoryObj->name = $request->name;
            $categoryObj->parent_id = !empty($request->parent_id)?$request->parent_id:0;
            $categoryObj->super_category_id = !empty($request->super_category_id)?$request->super_category_id:0;
            $categoryObj->slug = $categoryObj->createSlug($request->name,$id);
            if($request->hasFile('image')) {
                $categoryObj->image =   $this->fileUpload($request,config('application.category_image_path'));
            }
            $categoryObj->save();
            flash('category Save Successfully')->success()->important();
            return redirect('/administrator/category/list');
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
    	
        $this->query = Category::where('id','!=',0);        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $editLink = url("administrator/category/edit/$row->id");
    			$action = "<a href='$editLink' class='btn btn-primary text-white'><i class='fa fa-pencil'></i></a> ";
    			$action .= "<a data_id='$row->id' href='#' class='btn btn-danger deleteCategory text-white'><i class='fa fa-trash'></i></a>";
                
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
        $message = 'category not found';
        
        $categoryObj = Category::find($request->id);
        if(isset($categoryObj->id)){
            $subCategoryObj = Category::whereParentId($categoryObj->id)->first();
            if(empty($subCategoryObj->id)){
                $categoryObj->delete();
                $status = self::$SUCCESS;
                $message = "category Deleted Successfully";
            }
            else{
                $message = "category have subcategories ";
            }
        }
        

        $result = array(
            'status'=>$status,
            'message'=>$message
        );

        return response()->json($result);
    }
}
