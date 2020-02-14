<?php

namespace App\Http\Controllers\news;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\View;
class ArticleController extends Controller
{
	private $pathViewSlider = 'news.pages.article.';
	private $controllerName = 'article';
	private $model;
	private $params;

	public function __construct()
	{
		view()->share('controllerName', $this->controllerName);  
	}	
	public function index( Request $request)
	{
		$params['article_id'] = $request->category_id;
		$articleModel  = new ArticleModel(); 
		
		$itemsArticle   = $articleModel->getItem($params,['task'=>'news-get-item']); 
		// if (empty($itemsArticle))  return redirect()->route('home');
		
		$itemsLatest   = $articleModel->listItems(null,['task'=>'news-list-items-latest']); 
		return view($this->pathViewSlider.'index',[
			'params'        =>$this->params,  
			'itemsArticle'   => $itemsArticle,
			'itemsLatest'   => $itemsLatest,
		]);
	}

}
