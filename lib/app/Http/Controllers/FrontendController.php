<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;
class FrontendController extends Controller
{
    public function getHome()
    {
    	//day giao dien dong thoi dua ca co so du lieu ra
    	$data['featured'] = Product::where('prod_featured',1)->orderBy('prod_id','desc')->take(8)->get();//take la lay ra ban ghi 
    	//san pham moi
    	$data['new']  = Product::orderBy('prod_id','desc')->take(8)->get();
    	return view('frontend.home',$data);
    }
    public function getDetail($id)
    {
    	//ben canh tai view thi phi lay co so du lieu sp ra
    	$data['item'] = Product::find($id);
    	//lay ra danh sach cac binh luan
    	$data['comments'] = Comment::where('com_product',$id)->get();
    	return view('frontend.details',$data);
    	//neu cac view co du lieu chung thi vao App\Providers de view()->share cho no
    }
    public function getCategory($id)
    {
    	$data['catename'] =Category::find($id);
    	$data['items'] = Product::where('prod_cate',$id)->orderBy('prod_id','desc')->paginate(4);
    	return view('frontend.category',$data );
    }
    public function postComment(Request $request,$id)
    {
    	$comment = new Comment;
    	$comment->com_name= $request->name;
    	$comment->com_email= $request->email;
    	$comment->com_content= $request->content;
    	$comment->com_product =$id;
    	$comment->save();
    	return back();
    }
    public function getSearch(Request $request)
    {
    	//khoi tao keywork 
    	
    	$result = $request->result;
    	$data['keyword'] = $result;
   		//sau khi co tu khoa,ta se lam cong viec bo khoang trang,thay bang ki tu % bang ham sau,giai thuat tim kiem
   		$result = str_replace(' ', '%', $result);
   		//sau khi co dk result dung,ta se chay truy van
   		$data['items'] = Product::where('prod_name','like','%'.$result.'%')->orWhere('prod_price','like','%'.$result.'%')->get();
   		return view('frontend.search',$data); 
    }
}
