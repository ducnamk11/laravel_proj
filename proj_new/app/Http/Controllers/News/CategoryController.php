<?php

namespace App\Http\Controllers\news;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\View;
class CategoryController extends Controller
{
	private $pathViewSlider = 'news.pages.category.';
	private $controllerName = 'category';
	private $model;
	private $params;

	public function __construct()
	{
		view()->share('controllerName', $this->controllerName);  
	}	
	public function index( Request $request)
	{
		$params['category_id'] = $request->category_id;
		$articleModel  = new ArticleModel(); 
		$categoryModel  = new CategoryModel(); 
		$itemsCategory   = $categoryModel->getItem($params,['task'=>'news-get-item']); 
		if (empty($itemsCategory))  return redirect()->route('home');
 		$itemsLatest   = $articleModel->listItems(null,['task'=>'news-list-items-latest']); 
		$itemsCategory['articles'] = $articleModel->listItems(['category_id'=>$itemsCategory['id']],['task'=>'news-list-items-in-category']);
		  
		return view($this->pathViewSlider.'index',[
			'params'        =>$this->params,  
			'itemsCategory'   => $itemsCategory,
			'itemsLatest'   => $itemsLatest,
 		]);
	}

}
