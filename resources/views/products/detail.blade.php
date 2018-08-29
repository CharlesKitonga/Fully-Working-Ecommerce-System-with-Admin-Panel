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
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				@include('layouts.frontLayout.front_sidebar')
			</div>
			
			<div class="col-sm-9 padding-right">
				<div class="product-details"><!--product-details-->
					<div class="col-sm-5">
						<div class="view-product">
							<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
								<a href="{{ asset('images/backend_images/products/large/'.$productDetails->image)}}">
									<img style="width: 350px; height: 350px;" class="mainImage" src="{{ asset('images/backend_images/products/medium/'.$productDetails->image)}}" alt="" />
								</a>
							</div>
						</div>
						<div id="similar-product" class="carousel slide" data-ride="carousel">
							
							  <!-- Wrapper for slides -->
							    <div class="carousel-inner">
									<div class="item active thumbnails">
										<a href="{{ asset('images/backend_images/products/large/'.$productDetails->image)}}" data-standard ="{{ 	asset('images/backend_images/products/small/'.$productDetails->image)}}">
											<img class="changeImage" style="width: 80px;" class="mainImage" src="{{ asset('images/backend_images/products/small/'.$productDetails->image)}}" alt="" />
										</a>
										@foreach($productAltImages as $altimage)
										<a href="{{asset('images/backend_images/products/large/'.$altimage->image)}}" data-standard ="{{ asset ('images/backend_images/products/small/'.$altimage->image) }}">
									  		<img class="changeImage" style="width: 80px; cursor: pointer;" src="{{ asset ('images/backend_images/products/small/'.$altimage->image) }}" alt="">
									  	</a>	
									  	@endforeach
									</div>
									
								</div>
						</div>

					</div>
					<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
							<img src="images/product-details/new.jpg" class="newarrival" alt="" />
							<h2>{{$productDetails->product_name }}</h2>
							<p>Product Code: {{$productDetails->product_code }}</p>
							<p>
								<select id="selSize" name="size" style="width: 210px">
									<option value="">Select Size</option>
									@foreach($productDetails->attributes as $sizes)
									<option value="{{ $productDetails->id}}-{{$sizes->size}}">{{$sizes->size}}</option>
									@endforeach
								</select>
							</p>
							<img src="images/product-details/rating.png" alt="" />
							<span>
								<span id="getPrice">Sh. {{$productDetails->price }}</span>
								<label>Quantity:</label>
								<input type="number" name="quantity" value="1" />
								@if($total_stock>0)
									<form name="addtocartForm" id="addtocartForm" action="{{url('/cart')}}" method="post">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="id" value="{{ $productDetails->id }}">
                                        <input type="hidden" name="name" value="{{ $productDetails->product_name }}">
                                        <input type="hidden" name="price" value="{{ $productDetails->price }}">
                                        <button type="submit" class="btn btn-fefault add-to-cart" id="cartButton"><i class="fa fa-shopping-cart"></i>Add to Cart</button>
                                     </form>
								@endif	
							</span>
							<p><b>Availability:</b> <span id="Availability">@if($total_stock>0) In Stock @else Out Of Stock @endif</p></span>
							<p><b>Material & Care:</b>{{$productDetails->care}}</p>
							<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
					</form>
					</div>
				</div><!--/product-details-->
				
				<div class="category-tab shop-details-tab"><!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
							<li><a href="#care" data-toggle="tab">Material and Care</a></li>
							<li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>
<!-- 							<li ><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
 -->						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade" id="description" >
							<div class="col-sm-12">
								<p>{{$productDetails->description }}</p>
							</div>
						</div>
						
						<div class="tab-pane fade" id="care" >
							<div class="col-sm-12">
								<p></p>
							</div>
						</div>
						
						<div class="tab-pane fade" id="delivery" >
							<div class="col-sm-12">
								<p>100% Original Products<br>
									Cash on Delivery
								</p>
							</div>
						</div>
					</div>
				</div><!--/category-tab-->

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