<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Session;
class Category extends Controller
{
    public function selectCategory(){
    	return DB::table('blog_category')->get()->toArray();
    }

    public function getListCategoryChild($listCategory, $parentId){
    	foreach ($listCategory as $cate){
    		if($cate->cat_parentId == $parentId){
    			echo $cate->cat_name.' ';
    		}
    	}
    }

    public function getCategoryParent($listCategory,$parent,$str=''){
    	foreach ($listCategory as $item) {
    		if($item->cat_parentId == $parent){
    			echo '<option value="'.$item->cat_id.'">'.$str.$item->cat_name.'</option>';
    			$this->getCategoryParent($listCategory,$item->cat_id,$str.'--');
    		}
    		
    	}

    }
    public function menuCategory(){
    	$listCategory = DB::table('blog_category')->get()->toArray();
    	$parent = 0;
    	#echo "<select>";
    	$this::getCategoryParent($listCategory, $parent, $str='');
    	#echo "</select>";
    }

    public function getAdd(){
        $data['categorys'] = DB::table('blog_category')->distinct()->get()->toArray();
        return view('admin.category.add',isset($data)? $data:NULL);
    }
    public function postAdd(Request $request){
        $rules =[
            'name' =>"required",
        ];
        $messages = [
            'name.required' =>'ten category khong duoc de trong',
        ];
        $Validator = Validator::make($request->all(),$rules,$messages);

        if($Validator->fails()){
            echo "loi Validator";
            $errors['errors']=$Validator->errors();
            return redirect()->back()->with($errors);
        }else{
            Session::flash('success','');
            Session::flash('error','');
            $arr['cat_name'] = $request->name;
            $arr['cat_parentId'] = $request->parentId;
            $arr['created_at'] = gmdate("Y-m-d H:i:s",time()+7*3600);
            DB::table('blog_category')->insert($arr);
            echo "them thanh cong";
            $errors['success'] = 'thêm category thành công';
            Session::flash('success','thêm category thành công');
            return redirect()->back();
        }
    }

    public function getEdit(){
        $data['categories'] = DB::table('blog_category')->get()->toArray();
        return view('admin.category.edit',$data);
    }
    public function postEdit(Request $request){
        $rules =[
            'name' =>"required",
        ];
        $messages = [
            'name.required' =>'ten category khong duoc de trong',
        ];
        $Validator = Validator::make($request->all(),$rules,$messages);

        if($Validator->fails()){
            echo "loi Validator";
            $errors['errors']=$Validator->errors();
            return redirect()->back()->with($errors);
        }else{
            Session::flash('success','');
            Session::flash('error','');
            $cat_id = $request->cat_id;
            $arr['cat_name'] = $request->name;
            $arr['cat_parentId'] = $request->parentId;
            $arr['updated_at'] = gmdate("Y-m-d H:i:s",time()+7*3600);
            DB::table('blog_category')->where('cat_id',$cat_id)->update($arr);
            echo "them thanh cong";
            Session::flash('success','thêm category thành công');
            return redirect()->back()->with($errors);
        }
    }

    public function postDel($cat_id){
        DB::table('blog_category')->where('cat_id',$cat_id)->delete();
        Session::flash('success','xoa thành công category');
        return redirect()->back();
    }
}
