<?php  
namespace App\Helpers; 
use Illuminate\Support\Str;

class URL  
{
	// tạo ra 1 link chi tiết của phần tử
	public static function linkCategory($id,$name)
	{
		return     route('category/index',[
			'category_id'   =>$id,
			'category_name' =>Str::slug($name)]);
	}
	public static function linkArticle($id,$name)
	{
		return     route('article/index',[
			'article_id'   =>$id,
			'article_name' =>Str::slug($name)]);
	}
}
?>