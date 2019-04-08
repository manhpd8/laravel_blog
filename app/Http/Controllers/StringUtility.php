<?php 
namespace App\Http\Controllers;

class StringUtility extends Controller{
	public static  function isNull($str){
		if($str == null || $str=='') return true;
		$str = trim($str);
		if(strlen($str) == 0) return true; 
		return false;
	}
}
?>
