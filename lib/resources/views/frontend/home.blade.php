@extends('frontend.master')
@section('main')
@section('title','TRANG CHU')
		<div id="wrap-inner">
						
						<div class="products">
							<h3>sản phẩm mới</h3>
							<div class="product-list row">
								@foreach($new as $items)
								<div class="product-item col-md-3 col-sm-6 col-xs-12">
									<a href="#"><img width="150px" src="{{asset('lib/storage/app/avatar/'.$items->prod_img)}}" class="img-thumbnail"></a>
									<p><a href="#">{{$items->prod_name}}</a></p>
									<p class="price">{{number_format($items->prod_price,0,',','.')}} VNĐ</p>	  
									<div class="marsk">
										<a href="{{asset('detail/'.$items->prod_id.'/'.$items->prod_slug.'.html')}}">Xem chi tiết</a>
									</div>                                    
								</div>
								@endforeach
							</div>    
						</div>
						<div class="products">
							<h3>sản phẩm nổi bật</h3>
							<div class="product-list row">
								@foreach($featured as $item)
								<div class="product-item col-md-3 col-sm-6 col-xs-12">
									<a href="#"><img width="150px" src="{{asset('lib/storage/app/avatar/'.$item->prod_img)}}" class="img-thumbnail"></a>
									<p><a href="#">{{$item->prod_name}}</a></p>
									<p class="price">{{number_format($item->prod_price,0,',','.')}} VNĐ</p>	  
									<div class="marsk">
										<a href="{{asset('detail/'.$item->prod_id.'/'.$item->prod_slug.'.html')}}">Xem chi tiết</a>
									</div>                                    
								</div>
								@endforeach
							</div>                	                	
						</div>

		</div>
@stop
					
				