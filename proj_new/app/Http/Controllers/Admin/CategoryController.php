<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModel; // mainmodel la slidermodel -> để dễ copy và chỉnh sửa
use App\Http\Requests\CategoryRequest as MainRequest; // mainmodel la slidermodel -> để dễ copy và chỉnh sửa
class CategoryController extends BaseController
{
	private $pathViewCategory = 'admin.pages.category.';
	private $controllerName = 'category';
	private $model;
	private $params;
	public function __construct()
	{
		 $this->model = new mainModel(); //mainmodel la slidermodel - gọi được hết ở các function bên dưới, k cần khởi tạo lại
		 $this->params['pagination']['totalItemsPerPage']= 8;  
		 view()->share('controllerName', $this->controllerName); // định nghĩa controllerName đưa ra View
		}	

		public function index( Request $request)
		{
			$this->params['filter']['status'] = $request->input('filter_status','all');
			$this->params['search']['field'] = $request->input('search_field','');
			$this->params['search']['value'] = $request->input('search_value','');
			$items = $this->model->listItems($this->params,['task'=>'admin-list-items']);
			$itemsStatusCount = $this->model->countItems($this->params,['task'=>'admin-count-items-group-by-status']);
			return view( $this->pathViewCategory.'index',[
				'params'=>$this->params,
				'items'=>$items,
				'itemsStatusCount'=>$itemsStatusCount
			]);
		}

		public function form(Request $request)
		{ 	 	
			$item = null;
			if ($request->id !==null) {
				$params['id'] = $request->id;
				$item  = $this->model->getItem($params,['task'=>'get-item']);
			} 	
			return view($this->pathViewCategory.'form',['item'=>$item]);	
			
		}
		public function status(Request $request)
		{ 	 
			$params['currentStatus'] = $request->status;
			$params['id']            = $request->id;
			$this->model->saveItem($params,['task'=>'change-status']);
			return redirect()->route($this->controllerName)->with('zvn_notify', 'Phần tử được cập nhật thành công!');
		}

		public function is_home(Request $request)
		{ 	 
			$params['currentIsHome'] = $request->is_home;
			$params['id']            = $request->id;
			$this->model->saveItem($params,['task'=>'change-isHome']);
			return redirect()->route($this->controllerName)->with('zvn_notify', 'Phần tử được cập nhật thành công!');
		}
		public function display(Request $request)
		{ 	 
			$params['display'] 	= $request->display;
			$params['id']       = $request->id; 
			$this->model->saveItem($params,['task'=>'change-display']); //die('function stop in here');
			return redirect()->route($this->controllerName)->with('zvn_notify', 'Phần tử được cập nhật thành công!');
		}
		public function delete(Request $request)
		{ 		
			$params['id']            = $request->id;
			$this->model->deleteItem($params,['task'=>'delete-item']);
			return redirect()->route($this->controllerName)->with('zvn_notify', 'Phần tử được xóa thành công!');
		}
		public function save(MainRequest $request)
		{ 		 
			if ($request->method()=='POST') {
				$params = $request->all();
				$task = 'add-item';
				$notify='thêm phần tử thành công!';
				if ($params['id'] !==null) {
					$task='edit-item';
					$notify = 'cập nhật phần tử thành công!';
				}
				$this->model->saveItem($params,['task'=>$task]);
				return redirect()->route($this->controllerName)->with('zvn_notify',$notify);
			}
		}
	}
