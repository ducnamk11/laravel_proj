<?php  
namespace App\Helpers; 
use Config;
class Template 
{
	public static function showAreaSearch($controllerName,$paramsSearch)
	{ 		
		$xhtml = null;
		$tmplField = Config::get('zvn.template.search');
		$fieldInController = Config::get('zvn.config.search');
		$controllerName = array_key_exists($controllerName,$fieldInController) ? $controllerName : 'default';
		$xhtmlField = null;
		
		foreach ($fieldInController[$controllerName] as $field) {
			$xhtmlField .= sprintf('<li><a href="#" class="select-field" data-field="%s">%s</a></li>',$field,$tmplField[$field]['name']);
		}

		$searchField =(in_array($paramsSearch['field'],$fieldInController[$controllerName])) ? $paramsSearch['field'] : 'all';
		$xhtml.= sprintf('
			<div class="input-group">
			<div class="input-group-btn">
			<button type="button" class="btn btn-default dropdown-toggle btn-active-field" data-toggle="dropdown" aria-expanded="false">
			%s<span class="caret"></span>
			</button>
			<ul class="dropdown-menu dropdown-menu-right" role="menu">
			%s
			</ul>
			</div>
			<input type="text" name="search_value" class="form-control"  value="%s">
			<input type="hidden" name="search_field" value="%s">
			<span class="input-group-btn">
			<button id="btn-clear-search" type="button" class="btn btn-success"
			style="margin-right: 0px">Xóa tìm kiếm</button>
			<button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
			</span>
			</div>
			',$tmplField[$searchField]['name'],$xhtmlField,$paramsSearch['value'],$searchField); 			

		return $xhtml;
	}				
	public static function showButtonFilter($controllerName,$itemsStatusCount,$currentFilterStatus,$paramsSearch)
	{
		$xhtml = null; 
		$tmplStatus		 = Config::get('zvn.template.status');
		if (count($itemsStatusCount)>0) {
			array_unshift( $itemsStatusCount,[
				'count'                =>array_sum(array_column($itemsStatusCount, 'count')),
				'status'               =>'all']);
			foreach ($itemsStatusCount as  $item) {
				$statusValue           = $item['status'];
				$statusValue           = array_key_exists($statusValue,$tmplStatus) ? $statusValue :'default' ;
				$currentTemplateStatus = $tmplStatus[$statusValue];
				$class = ($currentFilterStatus ==$statusValue) ?'btn-danger' :'btn-info';
				$link = route($controllerName).'?filter_status='.$statusValue;
				if ($paramsSearch['value']!=='') {
					$link.="&search_field=".$paramsSearch['field']."&search_value=".$paramsSearch['value'];
				}

				$xhtml                 .= sprintf('<a href="%s" type="button" class="btn %s">%s <span class="badge bg-white">%s</span></a>',$link,$class,$currentTemplateStatus['name'],$item['count']); 			
			}
		}
		return $xhtml;
	}
	public static function showItemsHistory($by,$time)
	{
		$xhtml = sprintf(
			'<p><i class="fa fa-user"></i> %s</p>
				<p><i class="fa fa-clock-o"></i> %s</p>',$by,date(Config::get('zvn.format.long_time'),strtotime($time))); //cònig để hiện thị giờ phút giây or không !
		return $xhtml;
	}

	public static function showItemsStatus($controllerName,$id,$statusValue)
	{
		$tmplStatus            = Config::get('zvn.template.status');
		$statusValue           = array_key_exists($statusValue,$tmplStatus) ? $statusValue :'default' ;
		$currentTemplateStatus = $tmplStatus[$statusValue]; 
		
		$link                  = route($controllerName.'/status',['status'=>$statusValue,'id'=>$id]);
		$currentTemplateStatus = $tmplStatus[$statusValue];
		$xhtml                 = sprintf(
			'<a href="%s" type="button" class="btn btn-round %s"> %s</a>',$link,$currentTemplateStatus['class'],$currentTemplateStatus['name']); 
		return $xhtml;
	} 
	public static function showItemsSelect($controllerName,$id,$displayValue,$fieldName)
	{
		$tmplStatus = Config::get('zvn.template.'.$fieldName);
		$link = route($controllerName.'/'.$fieldName,[$fieldName=>'value_new','id'=>$id]);

		$xhtml = sprintf( '<select name = "select_change_attr" data-url="%s" class="form-control">',$link);
		foreach ($tmplStatus as $key => $value) {
			if ($key == $displayValue) {
				$xhtml .= sprintf(
					'<option selected = "selected" data-url="%s"">%s</option>',$link,$value['name']) ;
			}else{
				$xhtml .= sprintf(
					'<option value="%s">%s</option>',$key,$value['name']) ;
			}
			
		}
		$xhtml.= '</select>';

		return $xhtml;
	}

	public static function showItemsIsHome($controllerName,$id,$statusValue)
	{
		$tmplStatus            = Config::get('zvn.template.isHome');
		$statusValue           = array_key_exists($statusValue,$tmplStatus) ? $statusValue :'default' ;
		$currentTemplateStatus = $tmplStatus[$statusValue]; 
		
		$link                  = route($controllerName.'/is_home',['is_home'=>$statusValue,'id'=>$id]);
		$currentTemplateStatus = $tmplStatus[$statusValue];
		$xhtml                 = sprintf(
			'<a href="%s" type="button" class="btn btn-round %s"> %s</a>',$link,$currentTemplateStatus['class'],$currentTemplateStatus['name']); 
		return $xhtml;
	}
	public static function showItemsThumb($controllerName,$thumbName,$thumbAlt)
	{
		$xhtml = sprintf(
			'<img src="%s" alt="%s" class="zvn-thumb"',asset('images/'.$controllerName.'/'.$thumbName),$thumbAlt); 
		return $xhtml;
	}
	public static function showButtonAction($controllerName,$id)
	{
		$tmplButton		 = Config::get('zvn.template.button');
		$buttonInArea	 = Config::get('zvn.config.button');
		$controllerName =(array_key_exists($controllerName, $buttonInArea)) ? $controllerName : 'default';
				$listButtons    = $buttonInArea[$controllerName];//['edit']['delete']
				$xhtml          = ' <div class="zvn-box-btn-filter">';
				foreach ($listButtons as $btn) {
					$currentButton = $tmplButton[$btn];
				// -----------đang đặt thủ công ----------
					$link          = 'http://proj_new.xyz/admin/'.$controllerName.$currentButton['route-name'].'/'.$id;  // gốc:  $link = route($controllerName. $currentButton['route-name'],['id'=>$id]);
					$currentButton =$tmplButton[$btn];
					$xhtml         .=sprintf('<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip" data-placement="top" data-original-title="%s">
						<i class="fa %s"></i>
						</a>',$link,$currentButton['class'],$currentButton['title'],$currentButton['icon']);
				}
				$xhtml .= '</div>';
				return $xhtml;
			}
			public static function showDateTimeFrontEnd($dateTime)
			{
				 return date_format(date_create($dateTime),Config::get('zvn.format.short_time'));
			}
			public static function showContent($content,$length,$prefix='...')
			{
				  $prefix = ($length==0) ? '' :$prefix;
				  $content = str_replace(['<p>','</p>'], '', $content);
				  return preg_replace('/\s+?(\S+)?$/','',substr($content,0,$length)).$prefix;
			}
		}
		?>