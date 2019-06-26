<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Models\Product;
use App\Models\Category;
use DB;
class ProductController extends Controller
{
    //
    public function getProduct()
    {
        $data['productlist']= DB::table('vp_products')->join('vp_categories','vp_products.prod_cate','=','vp_categories.cate_id')->orderBy('prod_id','desc')->get();
    	return view('backend.product',$data);
    }
    public function getAddProduct()
    {
        $data['catelist'] = Category::all();
    	return view('backend.addproduct',$data);

    }
     public function postAddProduct(AddProductRequest $request)
    {   
        $product = new Product;
        $fileName= $request->img->getClientOriginalName();
        $product->prod_name=$request->name;
        $product->prod_slug = str_slug($request->name);
        $product->prod_img=$fileName;
        $product->prod_accessories=$request->accessories;
        $product->prod_warranty=$request->warranty;
        $product->prod_promotion=$request->promotion;
        $product->prod_condition=$request->condition;
        $product->prod_price=$request->price;
        $product->prod_status=$request->status;
        $product->prod_description=$request->description;
        $product->prod_cate=$request->cate;
        $product->prod_featured=$request->featured;
        $product->save();
        $request->img->storeAs('avatar',$fileName);
        return back();
        
    }
     public function getEditProduct($id)
    {
        $data['product'] =Product::find($id);
        $data['listcate'] =Category::all();
    	return view('backend.editproduct',$data);

    }
    public function postEditProduct(Request $request,$id)
    {
        $product = new Product;
        $arr['prod_name'] = $request->name;
        $arr['prod_slug']  =str_slug($request->name);
        $arr['prod_accessories'] = $request->accessories;
        $arr['prod_warranty'] = $request->warranty;
        $arr['prod_promotion'] = $request->promotion;
        $arr['prod_condition'] = $request->condition;
        $arr['prod_price'] = $request->price;
        $arr['prod_status'] = $request->status;
        $arr['prod_description'] = $request->description;
        $arr['prod_cate'] = $request->cate;
        $arr['prod_featured'] = $request->featured;
        //anh
        // if($request->hasFile('img')) {
        //     $img=$request->img->getClientOriginalExtension();//co ten xong khoi tao luon $arr = chinh ten cua chung ta,sau di chuyen file ve noi luu anh
        //     $arr['prod_img'] = $img;
        //     $request->img->storeAs('avatar'.$img);
        // }
        $file = $request->file('img');
    $duoi = $file->getClientOriginalExtension();
    if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg')
        {
        return back()->with('errorCheck', 'Bạn chỉ được phép nhập ảnh có đuôi jpg, png, jpeg');
     }
        $img = str_random(5). '.' .$duoi;
        $file->storeAS('avatar', $img);
        $arr['prod_img'] = $img;
        $product::where('prod_id',$id)->update($arr);
        return redirect('admin/product');
    }  
    public function getDeleteProduct($id)
    {
    	  Product::destroy($id);
          return back();
    }
}
