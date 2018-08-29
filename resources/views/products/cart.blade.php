@extends('layouts.frontLayout.front_design')
@section('content')
<section id="cart_items">
	@if (sizeof(Cart::content()) > 0)
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				@if(Session::has('flash_message_success'))
		            <div class="alert alert-success alert-block">
		                <button type="button" class="close" data-dismiss="alert">×</button> 
		                <strong>{!! session('flash_message_success') !!}</strong>
		            </div>        
		        @endif
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td>Item</td>
							<td>Product Name</td>
							<td>Price</td>
							<td>Quantity</td>
							<td>Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                    @foreach (Cart::content() as $item)
						<tr>
	                        <td>
                                <a href="{{ url('shop', [$item->model->slug]) }}"><img style="height: 100px;" src="{{ asset('images/backend_images/products/small/'. $item->model->image) }}" alt="product" class="img-responsive cart-image"></a>
                            </td>
	                        <td>
								<a href="">{{ $item->name }}</a>
							</td>
							<td>
								<p>Sh.{{$item->price}}</p>
							</td>
							<td >
							<div class="cart_quantity_button" data-id="{{ $item->rowId }}">
								<a class="cart_quantity_up" href="{{url('/cart/update-quantity/'.$item->id.'/1')}}"> + </a>
								<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
								@if($item->quantity>1)
								<a class="cart_quantity_down" href="{{url('/cart/update-quantity/'.$item->id.'/-1')}}"> - </a>
								@endif
							</div>
							</td>
	                        <td>Sh.{{ $item->subtotal }}</td>
	                        <td class=""></td>
	                        <td>
	                            <form action="{{ url('cart', [$item->rowId]) }}" method="POST" class="side-by-side">
	                                {!! csrf_field() !!}
	                                <input type="hidden" name="_method" value="DELETE">
	                                <input  type="submit" class="btn btn-fefault add-to-cart" value="Remove">
	                            </form>
	                            <br>
	                            <form action="{{ url('switchToWishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
	                                {!! csrf_field() !!}
	                                <input type="submit" class="btn btn-default" value="To Wishlist">
	                            </form>
	                        </td>
                		</tr>
					@endforeach
					<tr class="table-image">
                        <td></td>
                        <td class="small-caps table-bg" style="text-align: right;">Your Total</td>
                        <td></td>
                        <td>Sh.{{ Cart::total() }}</td>
                        <td class="column-spacer"></td>
                        <td></td>
               		</tr>
					</tbody>
				</table>
			</div>
		</div>
		  @else
            <h3>You have no items in your shopping cart</h3>
            <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg"></a>
          @endif
</section> <!--/#cart_items-->

<section id="do_action">
	<div class="container">
		<!-- <div class="heading">
			<h3>What would you like to do next?</h3>
			<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
		</div> -->
		 <div class="box-footer">
        <div class="pull-left">
            <a href="{{url('/shop')}}" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>

        </div>
        <div  class="pull-right">
            <a href="{{ url('/shipping-info') }}" class="btn btn-default"><i class="fa fa-chevron-right"></i> Proceed to Checkout</a>
        </div>                          
        </div>
	</div>
</section><!--/#do_action-->

@endsection