<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
 class DashboardController extends BaseController
{
	private $pathViewSlider = 'admin.pages.dashboard.';
	private $controllerName = 'dashboard';
	public function __construct()
	{
		 view()->share('controllerName', $this->controllerName); // định nghĩa controllerName đưa ra View
	}
	public function index()
	{
		return view( $this->pathViewSlider.'index');
	}
	 
}
