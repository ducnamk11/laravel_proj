<?php
namespace App\Models;
use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class SliderModel extends AdminModel
{ 
	public function __construct()
	{
		$this->table               = 'slider';
		$this->folderUpload        = 'slider';
		$this->fieldSearchAccepted = ['id','name','description','link'];
		$this->crudNotAccepted     = ['_token', 'thumb_current',];
	}
	public function listItems($params=null, $option=null)
	{ 
	 
		// 
		if($option['task']=='admin-list-items') {
			$query =  $this->select('id','name','description','status','link','thumb','created','created_by','modified','modified_by');// == SliderModel::select('id','name'...)->get(); // self la SliderModel(=> chinh sua va copy)) 
			if ($params['filter']['status']!=='all' ) {
				$query->where('status','=',$params['filter']['status']);
			}
			if ($params['search']['value']!=='' ) {
				if ($params['search']['field']=='all') {
					$query->where(function ($query) use ($params)
					{
						foreach ($this->fieldSearchAccepted  as $column) {
							echo $query->orwhere($column,'LIKE',"%{$params['search']['value']}%");
						};
					});
				}else if(in_array($params['search']['field'], $this->fieldSearchAccepted)){
					$query->where($params['search']['field'],'LIKE',"%{$params['search']['value']}%");
				}
			}
			$result = $query->orderBy('id', 'desc')->paginate($params['pagination']['totalItemsPerPage']); // chỉ số phân trang bằng  =... kéo vào từ listitem-> slidẻ controller
		} 


		if($option['task']=='news-list-items') {
			$query =  $this->select('id','name','description', 'link','thumb')->where('status','=','active')->limit(5); 
			$result = $query->get()->toArray();
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
		if($option['task']=='change-status') {
			$status = (($params['currentStatus'])=='active') ? 'inactive' :'active';
 			self::where('id', $params['id'])->update(['status' => $status]);
		};
		if($option['task']=='add-item') {
			$params['thumb'] = $this->uploadThumb($params['thumb']);
			$params['created'] =  date('Y-m-d');
			$params['created_by'] = 'ducnamjr';
 			self::insert($this->prepareParams($params));
		}
		if($option['task']=='edit-item') { 
			if (!empty($params['thumb'])) {
				$this->deleteThumb($params['thumb_current']);
				$params['thumb'] = $this->uploadThumb($params['thumb']);
			}
			$params['modified'] =  date('Y-m-d');
			$params['modified_by'] = 'ducnamjr';
 			self::where('id',$params['id'])->update($this->prepareParams($params));
		}
	}
	public function getItem($params=null, $option=null)
	{
		if($option['task']=='get-thumb') {  
			$result = self::select('id','thumb')->where('id',$params['id'])->first();
		}

		if($option['task']=='get-item') {  
			$result = self::select('id','name','description','status','link','thumb')->where('id',$params['id'])->first();
		}
		return $result;
	}
	public function deleteItem($params=null, $option=null)
	{
		if($option['task']=='delete-item') {
			$item = self::getItem($params,['task'=>'get-thumb']);
			$this->deleteThumb($item['thumb']);
			self::where('id',$params['id'])->delete();
		}
	}
}
