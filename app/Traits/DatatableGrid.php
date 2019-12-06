<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait DatatableGrid
{
	protected $start;
	protected $limit;
	protected $columns;
	protected $searchColumns;
	protected $totalRecords = -1;
	protected $orderBy = "";
	protected $query;
	protected $groupBy = "";
	protected $countField = "*";
	protected $whereCondition;
	protected $queryCondition = "1 = 1";
	
	protected function setOrderBy(){
		
		$request=request();	
		
		$orderby = "";
		$columns = $this->columns;
		if($request->has('order') && $request->filled('order'))
    	{
    		$order = $request->input('order');
    		$index  = $order[0]['column'];
    		if(isset($columns[$index]))
    		{
    			$orderby = $columns[$index].' '.$order[0]['dir'];
			}
    	}
    	
//     	$this->orderBy = !empty($this->orderBy) ? $this->orderBy.", ".$orderby : $orderby;
    	if(!empty($orderby)){
    		$this->orderBy = $orderby;
    	}
	}

	protected function setGroupBy($field){
		$this->groupBy = $field;
	}
	
	protected function setWhereCondition($whereCondition){
		
		$this->whereCondition = !empty($whereCondition) ? $this->whereCondition." and ".$whereCondition: $whereCondition;
		
	}
	protected function setSearchCondition(){
		
		$request=request();	
		
		$where = "";
		$columns = !empty($this->searchColumns) ? $this->searchColumns : $this->columns;
		$searchValue = $request->filled("search.value") ? $request->input("search.value") : '';
		if($request->filled("columns") && !empty($searchValue)){
		    $searchValue = "%$searchValue%";
		    $searchValue = \DB::getPdo()->quote($searchValue);
		    
			$gColumns = $request->input("columns");
			
			foreach($gColumns as $key=>$column){
				if(!empty($columns[$key])){
					if($column['searchable'] == true){
						$where.= $columns[$key]." LIKE $searchValue or ";
					}
				}
			}
			$where = '('.substr_replace($where, '', -3).')';
		}
		
		$this->whereCondition = !empty($this->whereCondition) ? $this->whereCondition." and ".$where : $where;
	}
	
	private function setLimit(){
		$request=request();	
		
		$this->start = $request->filled('start')?trim($request->input('start')):0;
		$this->limit = $request->input('length');
		$this->limit = $this->limit == '-1' ? null : $this->limit;
	}
	private function setCountField($field){
		$this->countField = $field;
		
	}
	private function getCountField(){
		return $this->countField;
	}
	// private function getLimit(){
	// 	$request=request();	
		
	// 	$this->start = $request->filled('start')?trim($request->input('start')):0;
	// 	$this->limit = $request->input('length');
	// 	$this->limit = $this->limit == '-1' ? null : $this->limit;
	// }
	
	protected function getGridData(){
		$query = $this->query;
		$request=request();	
		
		$this->setLimit();
		
		$where= $this->whereCondition;
		$orderby = $this->orderBy;
		$groupby = $this->groupBy;
		$start = $this->start;
		$limit = $this->limit;
		
		$query->when($where, function($query) use($where){
			$query->whereRaw($where);
		});
		
		if($this->totalRecords != -1){
			$countRecords = $this->totalRecords;
		}else{
			$countQuery = $query;
			$countField = $this->getCountField();
			$countRecords = $countQuery->count(\DB::raw($countField));
		}
		$query->when($start, function($query) use($start){
			$query->offset($start);
		});
		$query->when($limit, function($query) use($limit){
			$query->limit($limit);
		});
		$query->when($orderby, function($query) use($orderby){
			$query->orderByRaw($orderby);
		});
		$query->when($groupby, function($query) use($groupby){
			$query->groupBy($groupby);
		});
		
		//print query
// 		dd($query->toSql());
		
		$output = array(
    		"draw" => intval($request->input('draw')),
    		"recordsTotal" => $countRecords,
    		"recordsFiltered" => $countRecords,
    		"data" => $query->get()
    	);
		return $output;
	}
}
