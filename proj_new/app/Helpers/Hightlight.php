<?php  
namespace App\Helpers; 
use Config;
class Hightlight  
{
	public static function show($input,$paramsSearch,$field)
	{
		if ($paramsSearch['value']=='') { return $input;}

		if ($paramsSearch['field']=='all' OR $paramsSearch['field']==$field) {
			return preg_replace("/".preg_quote($paramsSearch['value'],'').'/i','<span class = "highlight">$0</span>', $input);
		}  
		return $input;
	}
}
?>