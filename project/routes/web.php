<?php

use App\Http\Controllers\admin\AdminOrderdetailController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\clients\InforController;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\clients\ProductsController;
use App\Http\Controllers\clients\ContactController;
use App\Http\Controllers\clients\CartsController;
use App\Http\Controllers\clients\CheckoutController;
use App\Http\Controllers\clients\DetailProductController;
use App\Http\Controllers\clients\LoginController;
use App\Http\Controllers\clients\OrderedController;
use App\Http\Controllers\clients\AboutController;


//Admin
use App\Http\Controllers\admin\LoginAdminController;
use App\Http\Controllers\admin\AdminOrderedcontroller;
use App\Http\Controllers\admin\Productcontroller;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\CategoryController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/san-pham', [ProductsController::class, 'index'])->name('product');
Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');
Route::post('/lien-he', [ContactController::class, 'postContact'])->name('post-contact');
Route::get('/gio-hang', [CartsController::class, 'index'])->name('carts');
Route::post('/gio-hang', [CartsController::class, 'updateQuantity'])->name('update-carts');
Route::post('/xoa-san-pham-gio-hang/{id?}', [CartsController::class, 'deleteProductCart'])->name('delete-product-cart');
Route::get('/thanh-toan', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/thanh-toan', [CheckoutController::class, 'create'])->name('post-checkout');
Route::get('/chi-tiet-san-pham/{id?}', [DetailProductController::class, 'index'])->name('detail-product');
Route::post('/danh-gia-san-pham/{id?}', [DetailProductController::class, 'postRating'])->name('rating-product');
Route::post('/them-vao-gio-hang/{id?}', [CartsController::class, 'addCart'])->name('add-cart');
Route::get('/tai-khoan', [LoginController::class, 'index'])->name('login');
Route::post('/postLogin', [LoginController::class, 'postLogin'])->name('postLogin');
Route::post('/tai-khoan', [LoginController::class, 'create'])->name('newUser');
Route::get('/logout', [LoginController::class, 'getLogout'])->name('logout');
Route::get('/don-mua', [OrderedController::class, 'index'])->name('ordered');
Route::post('/don-mua/{id?}', [OrderedController::class, 'updateStatus'])->name('update-status');
Route::get('/tim-kiem-san-pham/{search?}', [ProductsController::class, 'search'])->name('search');
Route::get('/gioi-thieu', [AboutController::class, 'index'])->name('about');
Route::get('/thong-tin-ca-nhan', [InforController::class, 'index'])->name('information');
Route::post('/cap-nhat-thong-tin', [InforController::class, 'updateInfor'])->name('update-infor');
Route::post('/doi-mat-khau', [InforController::class, 'changePass'])->name('change-password');

//Xử lý cho admin
Route::prefix('admin')->group(function () {
    Route::get('/san-pham', [Productcontroller::class, 'index'])->name('admin.product');
    Route::get('/san-pham/tao-moi', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/san-pham/tao-moi', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/san-pham/sua/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/product/{id}', [Productcontroller::class, 'update'])->name('admin.product.update');
    Route::delete('/san-pham/xoa/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    Route::get('/san-pham/tim-kiem', [Productcontroller::class, 'search'])->name('admin.product.search');


    Route::get('/don-hang', [AdminOrderedcontroller::class, 'index'])->name('admin.orderd');
    Route::get('/don-hang/huy', [AdminOrderedcontroller::class, 'destroy'])->name('admin.orderd.destroy');
    Route::get('/don-hang/momo', [AdminOrderedcontroller::class, 'momolist'])->name('admin.orderd.momo');
    Route::get('/don-hang/chi-tiet/{id}', [AdminOrderdetailController::class, 'index'])->name('admin.orderdetail');
    Route::get('/don-hang/chi-tiet/cap-nhat/{id}', [AdminOrderdetailController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::get('/don-hang/tim-kiem', [AdminOrderedcontroller::class, 'search'])->name('admin.orderd.search');
    Route::get('/don-hang/don-huy', [AdminOrderedcontroller::class, 'getOrder'])->name('admin.orderd.listreturn');


    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    Route::get('/momo/pay/{orderID}', [PaymentController::class, 'payWithMomo'])->name('momo.pay');
    Route::post('/momo/callback', [PaymentController::class, 'momoCallback'])->name('momo.callback');
    Route::post('/checkout/process', [PaymentController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/momo-callback', [PaymentController::class, 'momoCallback'])->name('checkout.momoCallback'); 
    Route::post('/checkout/momo-callback', [PaymentController::class, 'momoCallback']); 

    Route::get('/admin/momo-transactions', [PaymentController::class, 'index_list'])->name('admin.momo.index');





    Route::get('/', [LoginAdminController::class, 'index'])->name('admin.login');
    Route::post('/', [LoginAdminController::class, 'login'])->name('admin.login');
});
