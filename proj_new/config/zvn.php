<?php

return [
	'url'=>[
		'prefix_admin' =>'admin',
		'prefix_news'  =>'news69',
	],
	'format'=>[
		'long_time'  =>'H:m:s d/m/Y',
		'short_time' =>'d/m/Y',
	],
	'template'=>[
		'status'=>[
			'all'      =>['name'=>'All','class'=>'btn-success'],
			'active'   =>['name'=>'Kích hoạt','class'=>'btn-success'],
			'inactive' =>['name'=>'Chưa kích hoạt','class'=>'btn-info'],
			'default'  =>['name'=>'default','class'=>'btn-info'],
			'block'    =>['name'=>'blocked','class'=>'btn-info']
		],
		'isHome'=>[
			'0'       =>['name'=>'Hiển thị','class'=>'btn-success'],
			'1'       =>['name'=>'Không Hiển thị ','class'=>'btn-info'],
			'default' =>['name'=>'Default','class'=>'btn-info'],
			'block'   =>['name'=>'blocked','class'=>'btn-info']
		],
		'form_ckeditor'=>[
			'class'       =>'form-control col-md-6 col-xs-12 col-sm-6 ckeditor',
		],
		'display'=>[
			'list'       =>['name'=>'Danh sách'],
			'grid'       =>['name'=>'Kiểu lưới'], 
			// 'other'       =>['name'=>'Kiểu hỗn hợp',], 

		],
		'type'=>[
			'normal'     =>['name'=>'Bình thường'],
			'feature'    =>['name'=>'Nổi bật'], 
			// 'other'       =>['name'=>'Kiểu hỗn hợp',], 
		],
		'form_label'=>[
			'class'      =>'control-label col-md-3 col-sm-3 col-xs-12',
		],	
		'form_input'=>[
			'class'      =>'form-control col-md-7 col-xs-12',
		],
		'form_ckeditor'=>[
			'class'      =>'col-md-6 col-sm-6 col-xs-12 ckeditor',
		],
		'search'=>[
			'all'         =>['name'=>'Search by All'],
			'id'          =>['name'=>'Search by ID'],
			'name'        =>['name'=>'Search by Name'],
			'username'    =>['name'=>'Search by Username'],
			'fullname'    =>['name'=>'Search by Fullname'],
			'email'       =>['name'=>'Search by Email'],
			'description' =>['name'=>'Search by Description'],
			'link'        =>['name'=>'Search by Link'],
			'content'     =>['name'=>'Search by content'],
		],
		'button'=>[
			'edit'	=>['class'=>'btn-success' ,'title'=>'edit'	,'icon'=>'fa-pencil','route-name'=>'/form'],
			'delete'=>['class'=>'btn-danger btn-delete'  ,'title'=>'delete','icon'=>'fa-trash'	,'route-name'=>'/delete'],
			'info'	=>['class'=>'btn-info'    ,'title'=>'view '	,'icon'=>'fa-pencil','route-name'=>'/info'],
		]
	],
	'config'=>[
		'search'=>[
			'slider'=>['all','id','link','name','description'],
			'category'=>['all','id','name'],
			'article'=>['all','name','content'],
			'default'=>['all','id','fullname'],
		],
		'button'=>[
			'slider'	=> ['edit','delete'],
			'category'	=> ['edit','delete'],
			'article'	=> ['edit','delete'],
			'default'	=> ['edit','delete','info'],
		],
	],

];
