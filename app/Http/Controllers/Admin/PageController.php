<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Traits\DatatableGrid;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use DatatableGrid;
    
    public function __construct()
    {
        $this->data['menu'] = 'pages';
    }

    public function index(){
        $this->data['subMenu'] = 'page_list';
        return view('admin.page_list',$this->data);
    }

    public function add(Request $request){
        $this->data['subMenu'] = 'page_add';
        return view('admin.page_add_edit',$this->data);       
    }

    public function edit(Request $request){
        $PageObj = Page::find($request->id);
        
        $this->data['subMenu'] = 'page_add';
        $this->data['page'] = $PageObj;
        return view('admin.page_add_edit',$this->data);       
    }

    public function save(Request $request){
        $id = $request->id;;
        $rules = array(
            'name'=>'required'
        );
      
        $validation = \Validator::make($request->all(),$rules);
        if($validation->fails()){
          
             flash(makeErrorMessage($validation->errors()->messages()))->error()->important();
             return back()->withInput(); 
        }
        else{
            $PageObj = !empty($id)?Page::find($id):new Page();
            $PageObj->name = $request->name;
            $PageObj->content = $request->content;
            $PageObj->meta_keyword = $request->meta_keyword;
            $PageObj->meta_description = $request->meta_description;
            $PageObj->display_order = is_numeric($request->display_order)?$request->display_order:0;
            $PageObj->navigation_type = is_numeric($request->navigation_type)?$request->navigation_type:0;
            $PageObj->slug = $PageObj->createSlug($request->name,$id);
            $PageObj->save();
            flash('Page Save Successfully')->success()->important();
            return redirect('/administrator/page/list');
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
    	
        $this->query = Page::where('id','!=',0);        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $editLink = url("administrator/page/edit/$row->id");
                $action ='';
                if(auth()->user()->can('edit page')){
                    $action .= "<a href='$editLink' class='btn btn-primary text-white'><i class='fa fa-pencil'></i></a> ";
                }
                if(auth()->user()->can('delete page')){
                    $action .= "<a data_id='$row->id' href='#' class='btn btn-danger deletePage text-white'><i class='fa fa-trash'></i></a>";
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
        $message = 'Page not found';
        
        $PageObj = Page::find($request->id);
        if(isset($PageObj->id)){
            $PageObj->delete();
            $status = self::$SUCCESS;
            $message = "Page Deleted Successfully";
        }
        

        $result = array(
            'status'=>$status,
            'message'=>$message
        );

        return response()->json($result);
    }
}
