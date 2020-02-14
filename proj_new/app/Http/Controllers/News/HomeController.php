<?php

namespace App\Http\Controllers\news;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
class HomeController extends Controller
{
	private $pathViewSlider = 'news.pages.home.';
	private $controllerName = 'home';
	private $model;
	private $params;

	public function __construct()
	{
		  view()->share('controllerName', $this->controllerName); // định nghĩa controllerName đưa ra View
		}	
		public function index( Request $request)
		{
			$sliderModel   = new SliderModel();
			$articleModel  = new ArticleModel();
			$categoryModel = new CategoryModel();
			$itemsSlider   = $sliderModel->listItems(null,['task'=>'news-list-items']); 
			$itemsCategory = $categoryModel->listItems(null,['task'=>'news-list-items-is-home']); 
			$itemsFeatured = $articleModel->listItems(null,['task'=>'news-list-items-featured']); 
			$itemsLatest   = $articleModel->listItems(null,['task'=>'news-list-items-latest']); 
				
			foreach ($itemsCategory as $key => $category) {
				$itemsCategory[$key]['articles'] = $articleModel->listItems(['category_id'=>$category['id']],['task'=>'news-list-items-in-category']);
				 
			} 
			return view($this->pathViewSlider.'index',[
				'params'        =>$this->params, 
				'itemsSlider'   => $itemsSlider,
				'itemsCategory' => $itemsCategory,
				'itemsFeatured' => $itemsFeatured,
				'itemsLatest'   => $itemsLatest,
			]);
		}

	}
