<?php

use Doctrine\DBAL\Logging\Middleware;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\CategorysController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PaymentController;

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


// -------------------user ---------------- //
Route::get('/', [UserController::class,'index'])->name('user.index');
//-------- login ----------- //
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'loginUser'])->name('loginUser');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');

//------- register ----------//
Route::get('/register', [LoginController::class,'register'])->name('register');

Route::post('/register', [LoginController::class,'register_create']);

//-----------active account--------------//
Route::get('/user-mail-active', [MailController::class,'mailActive'])->name('user.mail-active'); 
Route::get('/authenticate', [MailController::class,'authenticate'])->name('user.authenticate'); 
Route::get('/user-active/{gmail}', [MailController::class,'active'])->name('user.activation');
Route::get('/enter-active-code/{gmail}', [MailController::class,'enter_activecode'])->name('user.enter_activecode');

//------------forgot password----------------//
Route::get('/mail-password', [MailController::class,'mailPassword'])->name('user.mail-password'); 
Route::post('/mail-forgot-password', [MailController::class,'mailForgotPassword'])->name('user.mail-forgot-password'); 
Route::get('/reset-password/{gmail}/{token}', [MailController::class,'resetPassword'])->name('user.reset-password');
Route::get('/check-password/{gmail}/{token}', [MailController::class,'checkPassword'])->name('user.check-password');

Route::get('/product/{id}', [UserController::class,'product'])->name('product');
//product


Route::get('/search', [UserController::class,'search'])->name('search');
Route::get('/womanproduct',[UserController::class,'womanpro'])->name('womanpro');


//--------- OrderManagement -------//
Route::get('/OrderManagement', [UserController::class,'OrderManagement'])->name('OrderManagement');


//----------- cart -----------------//
Route::get('/cart', [CartController::class,'show'])->name('show_card');
Route::post('/add-cart/{id}', [CartController::class,'add'])->name('cart.add');
Route::post('/update-cart/{id}', [CartController::class,'update'])->name('cart.update');
Route::get('/delete-cart/{id}', [CartController::class,'delete'])->name('cart.delete');
//--------- checkout -------//
Route::get('/checkout', [CartController::class,'checkout'])->name('checkout');
Route::post('/checkout', [CartController::class, 'Postcheckout']);

Route::get('/accept-order/{id}/{token}', [MailController::class,'accept'])->name('xacnhan');


//--------------Thanh toán VNpay--------------------//
Route::post('/vn-pay', [PaymentController::class,'index'])->name('vnpay_payment');
Route::post('/vn-pay', [PaymentController::class,'vnpay_payment'])->name('vnpay');






// --------------------- end user ------------//


// ----------------------- ADMIN -------------- //
Route::prefix('/admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminsController::class, 'index'])->name('admin.index');

    // List category
    Route::get('/category', [CategorysController::class, 'category'])->name('admin.category');
    Route::get('/category_add', [CategorysController::class, 'category_add'])->name('admin.category_add');
    Route::post('/category_add', [CategorysController::class, 'category_create'])->name('admin.category_create');
    Route::get('/category_list/{id}', [CategorysController::class, 'category_list'])->name('admin.category_list');
    Route::get('/category_update_show/{id}', [CategorysController::class, 'category_update_show'])->name('admin.category_update_show');
    Route::post('/category_update_show/{id}', [CategorysController::class, 'category_update'])->name('admin.category_update');
    Route::get('/category_delete/{id}', [CategorysController::class, 'category_delete'])->name('admin.category_delete');

     // List Account
     Route::get('/account', [AccountsController::class, 'account'])->name('admin.account');
     Route::get('/account_update/{id}', [AccountsController::class, 'account_update'])->name('admin.account_update');
     Route::get('/account_delete/{id}', [AccountsController::class, 'account_delete'])->name('admin.account_delete');

    // List Product
    Route::get('/product', [ProductsController::class, 'product'])->name('admin.product');
    Route::get('/product_add', [ProductsController::class, 'product_add'])->name('admin.product_add');
    Route::post('/product_add', [ProductsController::class, 'product_create'])->name('admin.product_create');
    Route::get('/product_update_show/{id}', [ProductsController::class, 'product_update_show'])->name('admin.product_update_show');
    Route::post('/product_update_show/{id}', [ProductsController::class, 'product_update'])->name('admin.product_update');
    Route::get('/product_delete/{id}', [ProductsController::class, 'product_delete'])->name('admin.product_delete');
    // list brands
    Route::get('/brands', [BrandsController::class, 'brands'])->name('admin.brands');
    Route::get('/brands_add', [BrandsController::class, 'brands_add'])->name('admin.brands_add');
    Route::post('/brands_add', [BrandsController::class, 'brands_create'])->name('admin.brands_create');
    Route::get('/brands_update_show/{id}', [BrandsController::class, 'brands_update_show'])->name('admin.brands_update_show');
    Route::post('/brands_update_show/{id}', [BrandsController::class, 'brands_update_update'])->name('admin.brands_update_update');
    Route::get('/brands_delete/{id}', [BrandsController::class, 'brands_delete'])->name('admin.brands_delete');


    // list  banners
    Route::get('/banners', [BannersController::class, 'banners'])->name('admin.banners');
    Route::get('/banners_add', [BannersController::class, 'banners_add'])->name('admin.banners_add');
    // Route::post('/brands_add', [BrandsController::class, 'brands_create'])->name('admin.brands_create');
    // Route::get('/brands_update_show/{id}', [BrandsController::class, 'brands_update_show'])->name('admin.brands_update_show');
    // Route::post('/brands_update_show/{id}', [BrandsController::class, 'brands_update_update'])->name('admin.brands_update_update');
    // Route::get('/brands_delete/{id}', [BrandsController::class, 'brands_delete'])->name('admin.brands_delete');

    // list commnents
    Route::get('/comments', [CommentsController::class, 'comments'])->name('admin.comments');
    Route::get('/comments_add', [CommentsController::class, 'comments_add'])->name('admin.comments_add');

    // list order
    Route::get('/orders', [OrdersController::class, 'orders'])->name('admin.orders');

    // list attribute
    Route::get('/attribute', [AttributeController::class,'attribute'])->name('admin.attribute');
    Route::get('/attribute_add', [AttributeController::class,'attribute_add'])->name('admin.attribute_add');
    Route::post('/attribute_add', [AttributeController::class,'attribute_create'])->name('admin.attribute_create');
    Route::get('/attribute_update_show/{id}', [AttributeController::class,'attribute_update_show'])->name('admin.attribute_update_show');
    Route::get('/attribute_delete/{id}', [AttributeController::class, 'attribute_delete'])->name('admin.attribute_delete');

});
// login admin
Route::get('/loginAdmin', [AdminsController::class,'loginAdmin'])->name('admin.loginAdmin');
Route::post('/loginAdmin', [AdminsController::class,'PostloginAdmin']);
Route::get('/logoutAdmin', [AdminsController::class,'logoutAdmin'])->name('admin.logout');
// Route::get('send-mail',function (){

//     $userMail = 'lucbacit@gmail.com';
//     dispatch(new App\Jobs\SendEmailJob($userMail));
    
// });