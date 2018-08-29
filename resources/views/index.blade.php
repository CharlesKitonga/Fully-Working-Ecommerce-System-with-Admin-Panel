@extends('layouts.frontLayout.front_design')
@section('content')
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<?php $count = 1; ?>
							@foreach($sliderproducts->chunk(1) as $chunk)
							<div <?php if ($count==1) {  ?>class="item active" <?php }else{?> class ="item" <?php }?>>
								@foreach($chunk as $item)
								<div class="col-sm-6">
									<h2>{{$item->product_name}}</h2>
									<p>{{$item->description}}</p>
									<a href="{{url('/product/'.$item->id)}}" class="btn btn-default get">Get it now</a>
								</div>
								<div class="col-sm-6">
									<img src="{{ asset ('images/backend_images/products/medium/'.$item->image)}}" class="girl img-responsive" alt="" />
								</div>
								@endforeach
							</div>
							<?php $count++; ?>			
							@endforeach
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
				</div>
				
				<div class="col-sm-11 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">All Items</h2>
						@foreach($productsAll as $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{ asset('images/backend_images/products/small/'.$product->image)}}" alt="" />
											<h2>Sh.{{$product->price}}</h2>
											<p>{{$product->product_name}}</p>
											<a href="{{url('/product/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<img src="{{ asset('images/backend_images/products/small/'.$product->image)}}" alt="" />
												<h2>Sh.{{$product->price}}</h2>
												<p>{{$product->product_name}}</p>
												<a href="{{url('/product/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Quick Look</a>
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
				
				<div class="recommended_items"><!--recommended_items-->
					<h2 class="title text-center">recommended items</h2>
					
					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php $count = 1; ?>
							@foreach($relatedProducts->chunk(3) as $chunk)
								<div <?php if ($count==1) {  ?>class="item active" <?php }else{?> class ="item" <?php }?>>
									@foreach($chunk as $item)	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img style="width: 230px;" src="{{ asset ('images/backend_images/products/small/'.$item->image) }}" alt="" />
													<h2>Sh.{{$item->price}}</h2>
													<p>{{$item->product_name}}</p>
													<a href="{{url('product/'.$item->id)}}"><button type="button" class="btn btn-fefault add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button></a>
												</div>
												
											</div>
										</div>
									</div>
									@endforeach
								</div>
							<?php $count++; ?>			
							@endforeach
						</div>
						 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						  </a>
						  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
							<i class="fa fa-angle-right"></i>
						  </a>			
					</div>
				</div><!--/recommended_items-->	
				</div>
			</div>
		</div>
	</section>
@endsection