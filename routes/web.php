<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//admin login route
Route::match(['get', 'post'],'/admin', 'AdminController@login');

//Get error page
Route::get('404', 'ProductsController@product')->name('404');

// Home Page Routes
Route::get('/','IndexController@index');

//Category/ Listing Page Routes
Route::get('/products/{url}','ProductsController@products');

//Products details Page Routes
Route::get('/product/{id}','ProductsController@product');

//Get Product Attribute Price
Route::get('/get-product-price', 'ProductsController@getProductPrice');

//Checkout Controllers
Route::post('/order-place','CheckoutController@order_place');

Route::get('/manage-order','CheckoutController@manage_order');
Route::get('/view-order/{order_id}','CheckoutController@view_order');
//Add to cart route
Route::match(['get', 'post'],'/add-cart', 'ProductsController@addtocart');

//cart Page
Route::match(['get', 'post'],'/cart', 'ProductsController@cart');
Route::match(['get','post'],'/admin/delete_cart/{id}','ProductsController@deleteCart');
Route::match(['get','post'],'/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');

//Get shopping page
Route::get('shop', 'ProductsController@shop')->name('shop');

//following routes deal with shopping cart
Route::resource('cart', 'CartController', ['only' => ['store', 'update', 'destroy']]);
Route::post('store-payment','CheckoutController@storePayment');
Route::delete('emptyCart', 'CartController@emptyCart');
Route::post('switchToWishlist/{id}', 'CartController@switchToWishlist');

Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::resource('wishlist', 'WishlistController');
Route::post('switchToCart/{id}', 'WishlistController@switchToCart');

//Route::get('checkout','CheckoutController@step1');
Route::get('shipping-info','CheckoutController@shipping')->middleware('auth');
Route::post('shipping-info', 'CheckoutController@storePayment')->name('checkout.store');

//Guest Checkout Route
Route::any('/guest-checkout','CheckoutController@shipping')->name('guestCheckout.index');

//Registration page
Route::any('/users/register','UsersController@register');
Route::any('/users/login','UsersController@login');

//Contact us page
Route::any('contact','UsersController@contact');
Route::get('contact', function(){
	$config['center'] = 'Strathmore University, Nairobi';
	$config['zoom'] = '14';
	$config['map_height'] = '300px';
	$config['scrollwheel'] = false;

	GMaps::initialize($config);

	//Add a Marker
	$marker['position'] = 'Strathmore University, Nairobi';
	$marker['infowindow_content'] = 'Strathmore University';
	GMaps::add_marker($marker);

	$map = GMaps::create_map();

	return view('contact')->with('map', $map);
 });

//Admin Routes
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/settings','AdminController@settings');
Route::get('/admin/check-pwd','AdminController@chkPassword');
Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');

//Categories Routes (Admin)
Route::match(['get','post'],'/admin/categories/add_category','CategoryController@addCategory');
Route::match(['get','post'],'/admin/edit_category/{id}','CategoryController@editCategory');
Route::match(['get','post'],'/admin/delete_category/{id}','CategoryController@deleteCategory');
Route::get('/admin/categories/view_category','CategoryController@viewCategories');

//Products route
Route::match(['get','post'],'/admin/add_products','ProductsController@addProduct');
Route::match(['get','post'],'/admin/add_slider_images','IndexController@addSliderImages');
Route::match(['get','post'],'/admin/edit_product/{id}','ProductsController@editProduct');
Route::get('/admin/products/view_products','ProductsController@viewProducts');
Route::get('/admin/products/view_slider_products','IndexController@viewProducts');
Route::get('/admin/delete_product/{id}','ProductsController@deleteProduct');
Route::get('/admin/delete_slider_product/{id}','ProductsController@deleteSliderProduct');
Route::get('/admin/delete_product_image/{id}', 'ProductsController@deleteProductImage');
Route::get('/admin/delete_alt_image/{id}', 'ProductsController@deleteAltImage');

//Product Attributes routes
Route::match(['get', 'post'], 'admin/add_attributes/{id}', 'ProductsController@addAttributes');
Route::match(['get', 'post'], 'admin/edit_attributes/{id}', 'ProductsController@editAttributes');
Route::match(['get', 'post'], 'admin/add_images/{id}', 'ProductsController@addImages');
Route::get('/admin/delete_attribute/{id}','ProductsController@deleteAttribute');

//Manage Orders Route in Admin
Route::post('toggledeliver/{orderId}', 'OrderController@toggledeliver')->name('toggle.deliver');
Route::get('orders/{type?}','OrderController@Orders');
Route::match(['get','post'],'/admin/delete_order/{id}','OrderController@deleteOrder');
Route::match(['get','post'],'/admin/edit_order/{id}','OrderController@editOrder');

Route::get('/logout', 'AdminController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'ProductsController@search')->name('search');

Route::get('/mailable', function(){
	$order = App\Order::find(3);

	return new App\Mail\OrderPlaced($order);
});