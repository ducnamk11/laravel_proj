<?php
Route::get('/', function () {
	return view('welcome');
});
$prefixAdmin = Config::get('zvn.url.prefix_admin' );	 //admin
$prefixNews = Config::get('zvn.url.prefix_news' );	 //admin
Route::group(['prefix' => $prefixAdmin,'namespace'=>'admin'], function()  {
		//============SLIDER=================
	$prefix = 'slider';
	$controllerName = 'slider';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/',				['as'             =>$controllerName, 			'uses' =>$controller.'index']);
		Route::get('form/{id?}',	['as'             =>$controllerName.'/form', 	'uses' => $controller.'form' ])->where('id','[0-9]+');
		Route::get('delete/{id}',	['as'             =>$controllerName.'/delete', 	'uses' => $controller.'delete' ])->where('id','[0-9]+');
		Route::post('save',			['as'             =>$controllerName.'/save', 	'uses' => $controller.'save' ]);
		Route::get('change-status-{status}/{id}',['as' =>$controllerName.'/status',	'uses'=> $controller.'status' ])->where('id','[0-9]+');
	});
			//============categry=================
	$prefix = 'category';
	$controllerName = 'category';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/',				['as'             =>$controllerName, 			'uses' =>$controller.'index']);
		Route::get('form/{id?}',	['as'             =>$controllerName.'/form', 	'uses' => $controller.'form' ])->where('id','[0-9]+');
		Route::get('delete/{id}',	['as'             =>$controllerName.'/delete', 	'uses' => $controller.'delete' ])->where('id','[0-9]+');
		Route::post('save',			['as'             =>$controllerName.'/save', 	'uses' => $controller.'save' ]);
		Route::get('change-status-{status}/{id}',['as' =>$controllerName.'/status',	'uses'=> $controller.'status' ])->where('id','[0-9]+');
		Route::get('change-is_home-{is_home}/{id}',['as' =>$controllerName.'/is_home',	'uses'=> $controller.'is_home' ])->where('id','[0-9]+');
		Route::get('change-display-{display}/{id?}',['as' =>$controllerName.'/display',	'uses'=> $controller.'display' ])->where('id','[0-9]+');
	});
		//============article=================

	$prefix = 'article';
	$controllerName = 'article';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/',				['as'                 =>$controllerName, 			'uses' =>$controller.'index']);
		Route::get('form/{id?}',	['as'                 =>$controllerName.'/form', 	'uses' => $controller.'form' ])->where('id','[0-9]+');
		Route::get('delete/{id}',	['as'                 =>$controllerName.'/delete', 	'uses' => $controller.'delete' ])->where('id','[0-9]+');
		Route::post('save',			['as'                 =>$controllerName.'/save', 	'uses' => $controller.'save' ]);
		Route::get('change-status-{status}/{id}',['as'    =>$controllerName.'/status',	'uses'=> $controller.'status' ])->where('id','[0-9]+');
		Route::get('change-is_home-{is_home}/{id}',['as'  =>$controllerName.'/is_home',	'uses'=> $controller.'is_home' ])->where('id','[0-9]+');
		Route::get('change-display-{display}/{id?}',['as' =>$controllerName.'/display',	'uses'=> $controller.'display' ])->where('id','[0-9]+');
		Route::get('change-type-{type}/{id?}',['as'       =>$controllerName.'/type',	'uses'=> $controller.'type' ])->where('id','[0-9]+');
	});

		//============DASHBOARD=================
	$prefix = 'dashboard';
	$controllerName = 'dashboard';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/',['as'=>$controllerName, 'uses'=>$controller.'index']);
	});
});
// -----prefixNews-----
Route::group(['prefix' => $prefixNews,'namespace'=>'News'], function()  {
		//============HOMEPAGE=================

	$prefix = '';
	$controllerName = 'home';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/',['as'=>$controllerName, 'uses'=>$controller.'index'	]);
	});
		//============category=================

	$prefix         = 'chuyen-muc';
	$controllerName = 'category';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/{category_name}-{category_id}.php',['as'=>$controllerName.'/index', 'uses'=>$controller.'index'])
		->where('category_name','[0-9a-zA-Z_-]+')
		->where('category_id','[0-9]+');
	});
		//============article=================

	$prefix         = 'bai-viet';
	$controllerName = 'article';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/{article_name}-{article_id}.php',['as'=>$controllerName.'/index', 'uses'=>$controller.'index'])
		->where('article_name','[0-9a-zA-Z_-]+')
		->where('article_id','[0-9]+');
	});

});

