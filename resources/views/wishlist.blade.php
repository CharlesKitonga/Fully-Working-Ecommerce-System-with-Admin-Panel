@extends('layouts.frontLayout.front_design')
@section('content')
<section id="cart_items"><!-- wishlist items i used the cart ID -->
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{url('/')}}">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
         </div>
        @if (sizeof(Cart::instance('wishlist')->content()) > 0)
        <div class="box">
            @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
            @endif

            @if (session()->has('error_message'))
                <div class="alert alert-danger">
                    {{ session()->get('error_message') }}
                </div>
            @endif
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <th >Item</th>
                            <th >Product Name</th>
                            <th >Price</th>
                            <th >Quantity</th>
                            <th >Total</th>
                            <th class="column-spacer"></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach (Cart::instance('wishlist')->content() as $item)
                        <tr>
                             <td>
                                <a href="{{ url('shop', [$item->model->slug]) }}"><img style="height: 100px;" src="{{ asset('images/backend_images/products/small/'. $item->model->image) }}" alt="product" class="img-responsive cart-image"></a>
                            </td>
                            <td >
                                <a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }}</a>
                            </td>

                            <td >
                                <p>Sh.{{$item->price}}</p>
                            </td>
                            <td>{{$item->qty}} </td>
                            <td>Sh.{{ $item->subtotal }}</td>
                            <td class=""></td>
                            <td>
                                <form action="{{ url('wishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input  type="submit" class="btn btn-fefault add-to-cart" value="Remove">
                                </form>
                                <br>
                                <form action="{{ url('switchToCart', [$item->rowId]) }}" method="POST" class="side-by-side">
                                    {!! csrf_field() !!}
                                    <input type="submit" class="btn btn-default" value="To Cart">
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end container -->
        @else
            <h3>You have no items in your Wishlist</h3>
            <a href="/shop" class="btn btn-primary btn-lg">Continue Shopping</a>
        @endif
</section><!-- wishlist items -->
<section id="do_action">
    <div class="container">
         <div class="box-footer">
            <div class="pull-left">
                <a href="{{url('/shop')}}" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>

            </div>
            <div  class="pull-right">
                <form action="{{ url('/emptyWishlist') }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" class="btn btn-default" value="Empty Wishlist">
                    </form>
            </div>                          
        </div>
    </div>
</section><!--/#do_action-->

@endsection