
@extends('layouts.frontLayout.front_design')
@section('content')
	<section>
		<div class="container">
		@if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>        
        @endif
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
		@endif
		</div>
		<div class="search-container container">				
				<div class="search-container container">
		        <h1>Search Results</h1>
		        <p>{{$products->total()}} results for '{{ request()->input('query') }}'</p>
		        <div class="col-sm-9 padding-right">
			        <div class="features_items"><!--features_items-->
				        @foreach($products as $product)
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{ asset('images/backend_images/products/small/'.$product->image)}}" alt="" />
												<h2>Sh.{{$product->price}}</h2>
												<p>{{$product->product_name}}</p>
												<a href="{{url('product/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											<div class="product-overlay">
												<div class="overlay-content">
													<img src="{{ asset('images/backend_images/products/small/'.$product->image)}}" alt="" />
													<h2>Sh.{{$product->price}}</h2>
													<p>{{$product->product_name}}</p>
													<a href="{{url('/product/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-heart"></i>Quick View</a>
												</div>
											</div>
									</div>
									<div class="choose">
										<ul class="nav nav-pills nav-justified">
											<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
											<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
										</ul>
									</div>
								</div>
							</div>
						@endforeach
					</div><!--features_items-->	
				</div>	  	
 		{{ $products->appends(request()->input())->links() }}
		</div>
	</section>
@endsection