<?php
namespace App\Models;
use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class CategoryModel extends AdminModel
{ 
	public function __construct()
	{
		$this->table               = 'category';
		$this->folderUpload        = 'category';
		$this->fieldSearchAccepted = ['id','name'];
		$this->crudNotAccepted     = ['_token'];
	}
	public function listItems($params=null, $option=null)
	{ 

		if($option['task']=='admin-list-items') {
			$query =  $this->select('id','name','status','created','display','is_home','created_by','modified','modified_by');// == SliderModel::select('id','name'...)->get(); // self la SliderModel(=> chinh sua va copy)) 
			if ($params['filter']['status']!=='all' ) {
				$query->where('status','=',$params['filter']['status']);
			}
			if ($params['search']['value']!=='' ) {
				if ($params['search']['field']=='all') {
					$query->where(function ($query) use ($params)
					{
						foreach ($this->fieldSearchAccepted  as $column) {
							$query->orwhere($column,'LIKE',"%{$params['search']['value']}%");
						};
					});
				}else if(in_array($params['search']['field'], $this->fieldSearchAccepted)){
					$query->where($params['search']['field'],'LIKE',"%{$params['search']['value']}%");
				}
			}
			$result = $query->orderBy('id', 'desc')->paginate($params['pagination']['totalItemsPerPage']); 
		}  
		if($option['task']=='news-list-items') {
			$query =  $this->select('id','name')->where('is_home','=','1')->limit(8); 
			$result = $query->get()->toArray();
		} 

		if($option['task']=='news-list-items-is-home') {
			$query =  $this->select('id','name','display')->where('is_home','=',0)->limit(8); 
			$result = $query->get()->toArray();
		} 		
		if($option['task']=='admin-list-items-in-selectbox') {
			$query =  $this->select('id','name')->where('status','=','active')->orderBy('name','asc'); 
			$result = $query->pluck('name','id')->toArray();
		} 
		return $result;
	}

	public function countItems($params, $option)
	{
		$result =null;
		if($option['task']=='admin-count-items-group-by-status') {
			$result =  self::select(DB::raw('count(id) as count, status'))		 
			->groupBy('status')		
			->get()
			->toArray();
			$query = $this::groupBy('status')
			->select(DB::raw('status,COUNT(id) as count'));
			if ($params['search']['value']!=='' ) {
				if ($params['search']['field']=='all') {
					$query->where(function ($query) use ($params)
					{
						foreach ($this->fieldSearchAccepted  as $column) {
							$query->orwhere($column,'LIKE',"%{$params['search']['value']}%");
						};
					});
				}else if(in_array($params['search']['field'], $this->fieldSearchAccepted)){
					$query->where($params['search']['field'],'LIKE',"%{$params['search']['value']}%");
				}
			}
			$result = $query->get()->toArray();
		} 
		return $result;
	}
	public function saveItem($params=null, $option=null)
	{
		if($option['task']=='change-isHome') {
			$isHome = (($params['currentIsHome'])=='1') ? '0' :'1';
			self::where('id', $params['id'])->update(['is_home' => $isHome]);
		};
		if($option['task']=='change-status') {
			$status = (($params['currentStatus'])=='active') ? 'inactive' :'active';
			self::where('id', $params['id'])->update(['status' => $status]);
		};


		if($option['task']=='change-display') { 
			self::where('id', $params['id'])->update(['display' => $params['display']]);
		};
		if($option['task']=='add-item') {
			$params['created'] =  date('Y-m-d');
			$params['created_by'] = 'ducnamjr';
			self::insert($this->prepareParams($params));
		}
		if($option['task']=='edit-item') { 
			$params['modified'] =  date('Y-m-d');
			$params['modified_by'] = 'ducnamjr';
			self::where('id',$params['id'])->update($this->prepareParams($params));
		}
	}
	public function getItem($params=null, $option=null)
	{
		if($option['task']=='get-item') {  
			$result = self::select('id','name','status')->where('id',$params['id'])->first();
		}
		if($option['task']=='news-get-item') {  
			$result = self::select('id','name','display')->where('id',$params['category_id'])->first(); 
			if($result) $result = $result->toArray();
		}
		return $result;
	}
	public function deleteItem($params=null, $option=null)
	{
		if($option['task']=='delete-item') { 
			self::where('id',$params['id'])->delete();
		}
	} 
}
