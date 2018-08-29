<?php
use App\Http\Controllers\Controller;
$mainCategories = Controller::mainCategories();
$categories = Controller::categories();

?>
<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i>+254719366495</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> charleskyalo006@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li class="{{ set_active('wishlist') }}"><a href="{{ url('/wishlist') }}"><i class="fa fa-star"></i> Wishlist  ({{ Cart::instance('wishlist')->count(false) }})</a></li>
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li class="{{ set_active('cart') }}"><a href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i> Cart ({{ Cart::instance('default')->count(false) }})</a></li>
								@guest
								<li><a href="{{url('/register')}}"><i class="fa fa-user"></i>Create Account</a></li>
								<li><a href="{{url('/login')}}"><i class="fa fa-lock"></i> Login</a></li>
								@else
								<li>
								 <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                   @endguest 
							</ul>
						</div>
					</div>
					 <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{('/users/login')}}" method="post">
                        	{{csrf_field()}}
                            <div class="form-group">
                                <input type="text" class="form-control" id="email-modal" placeholder="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password-modal" placeholder="password">
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="{{ url('/users/register')}}"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{url('/')}}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    	@foreach($mainCategories as $cat)
	                                    	@if($cat->status=="1")
	                                        <li><a href="{{ asset('products/'.$cat->url)}}">{{$cat->category_name}}</a></li>
	                                        @endif
                                        @endforeach
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> 
                            @foreach($categories as $cat)
                                <li class="dropdown">
									<a data-toggle="collapse"  data-parent="#accordian" href="#{{$cat->id}}">
										 {{$cat->category_name}}<i class="fa fa-angle-down"></i>
									</a>
                                    <ul role="menu" class="sub-menu">
                                    	<div id="{{$cat->id}}" class="panel-collapse collapse">
											<div class="panel-body">
												<ul>
													@foreach($cat->categories as $subcat)
													<li><a href="{{ asset('/products/'.$subcat->url)}}">{{$subcat->category_name}} </a></li>
													@endforeach
												</ul>
											</div>
										</div>
                                    </ul>
                                </li>
                            @endforeach
								<li><a href="{{url('contact')}}">Contact</a></li>
							</ul>

						</div>
					</div>
					<div class="col-sm-3">
						<form action="{{ route('search') }}" method="GET" class="search-form">
					    <input type="text" name="query" id="query" value="{{ request()->input('query') }}" class="search-box" placeholder="Search for product" required >
					    <i class="fa fa-search search-icon"></i>
					</form>
					</div>

				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->