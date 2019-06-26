<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
use Mail;
class CartController extends Controller
{
    public function getAddCart($id)
    {
    	//muon them gio hang thi se su dung phương thức add từ thư viện cart
    	$product= Product::find($id);
    	Cart::add(['id' => $id, 'name' => $product->prod_name, 'qty' => 1, 'price' => $product->prod_price, 'options' => ['img' => $product->prod_img]]);
    	return redirect('cart/show');
    }
    public function getShowCart()
    {
    	$data['total'] =Cart::total();//hàm tính tổng tiền
    	$data['items']= Cart::content();//show ra thong tin cua sản phẩm
    	return view('frontend.cart',$data);
    }
    public function getDeleteCart($id)
    {
    	//có hai trường hợp,một là row 2 là all(như chỗ xóa tất cả)
    	if($id=='all') 
    	{
    		Cart::destroy(); //cái này là xóa hêt

    	}else
    	{
    		Cart::remove($id); //cái này       là xóa đơn,xóa 1 sản phẩm
    	}
    	return back();
    }
    public function getUpdateCart(Request $request)
    {
    	Cart::update($request->rowId,$request->qty); 
    }
    // public function postXacnhanmuahang(Request $request)
    // {
       
    // 	//tiến hành gửi maik
    // 	//ktra xem co lấy ra được dữ liệu k
        
    //     $data['info'] =$request->all();
    //     $email = $request->email;
    //     $data['cart'] = Cart::content();
    //     $data['total'] =Cart::total();
    //     //khi mà gửi mail dùng phương thức send
    //     Mail::send('frontend.email',$data,function($message) use ($email){
    //         $message->from('ungthilenxe3@gmail.com','cua hang');
    //         $message->to($email,$email);
    //         $message->cc('ungthilenxe4@gmail.com','cua hang');
    //         $message->subject('Xac nhan hoa don mua hang');//tieu de
    //     }); 
    //     return redirect('complete');
    // }
    //  public function getHoanthanh()
    //  {
    //      return view('frontend.complete');
    //  }
    public function postXacnhanmuahang(Request $request)
    {
        $data['info']= $request->all();
        $email =$request->email;
        $data['cart'] = Cart::content();
        
         $this->validate($request,[
                'email'=>'required|email',
            ],
                [
                    'email.email'=>'Email không đúng định dạng',
                ]);
        Mail::send('frontend.email',$data,function ($message) use ($email){
                $message->from('ungthilenxe3@gmail.com','Cửa hàng');
                $message->to($email,$email);
                $message->subject('Hóa Đơn Mua Hàng'); 
            });
        Cart::destroy();
        return redirect('complete');
    }
    public function getHoanthanh()
    {
        return view('frontend.complete');
    }
}   
