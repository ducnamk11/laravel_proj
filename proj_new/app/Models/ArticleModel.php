<?php
namespace App\Models;
use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class ArticleModel extends AdminModel
{ 
	public function __construct()
	{
		$this->table               = 'article as a';
		$this->folderUpload        = 'article';
		$this->fieldSearchAccepted = ['content','name'];
		$this->crudNotAccepted     = ['_token','thumb_current'];
	}
	public function listItems($params=null, $option=null)
	{ 
		$result =null;
		if($option['task']=='admin-list-items') {
			$query =  $this->select('a.id','a.name','a.status','a.created','a.content','a.thumb', 'a.type','c.name as category_name')
			->leftJoin('category as c','a.category_id','=','c.id');
			if ($params['filter']['status']!=='all' ) {
				$query->where('a.status','=',$params['filter']['status']);
			}
			if ($params['search']['value']!=='' ) {
				if ($params['search']['field']=='all') {
					$query->where(function ($query) use ($params)
					{
						foreach ($this->fieldSearchAccepted  as $column) {
							$query->orwhere('a.'.$column,'LIKE',"%{$params['search']['value']}%");
						};
					});

				}else if(in_array($params['search']['field'], $this->fieldSearchAccepted)){
					$query->where('a.'.$params['search']['field'],'LIKE',"%{$params['search']['value']}%");
				}
			}
			$result = $query->orderBy('a.id', 'desc')->paginate($params['pagination']['totalItemsPerPage']); 
		}  
		

		if($option['task']=='news-list-items') {
			$query =  $this->select('id','name')->where('is_home','=','1')->limit(8); 
			$result = $query->get()->toArray();
		} 

		if($option['task']=='news-list-items-is-home') {
			$query =  $this->select('id','name','display')->where('status','=','active')->limit(8); 
			$result = $query->get()->toArray();
		} 
		if($option['task']=='news-list-items-featured') {
			$query =  $this->select('a.id','a.name','a.content','a.thumb','a.created','c.name as category_name')
			->leftJoin('category as c','a.category_id','=','c.id')
			->where('a.status','=','active')
			->where('a.type','=','feature')
			->orderBy('a.id', 'asc')
			->take(3);  
			$result = $query->get()->toArray();

		} 
		if($option['task']=='news-list-items-latest') {
			$query =  $this->select('a.id','a.name','a.thumb','a.created','c.name as category_name')
			->leftJoin('category as c','a.category_id','=','c.id')
			->where('a.status','=','active')
			->orderBy('a.id', 'asc')
			->take(4);  
			$result = $query->get()->toArray();
			
		}
		if($option['task']=='news-list-items-in-category') {
			$query =  $this->select('id','name','content','thumb','created')
			->where('status','=','active')->where('category_id','=',$params['category_id'])
			->take(4);
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
		if($option['task']=='change-type') { 
			self::where('id', $params['id'])->update(['type' => $params['currentType']]);
		};
		if($option['task']=='add-item') {
			$params['thumb'] = $this->uploadThumb($params['thumb']);
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
			$result = self::select('id','name','content','status','thumb','category_id')->where('id',$params['id'])->first();
		}
		if($option['task']=='news-get-item') {  
			$result = self::select('a.id','a.name','a.content','a.category_id','a.thumb','c.name as category_name','a.created')
			->leftJoin('category as c','a.category_id','=','c.id')
			->where('a.id','=',$params['article_id'])
			->where('a.status','=','active')
			->first();
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
