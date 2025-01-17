<?php

use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\AboutComponent;
use App\Http\Livewire\ContactUsComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Livewire\User\UserComponent;

use App\Http\Livewire\Admin\AdminComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AddNewProductComponent;
use App\Http\Livewire\Admin\AdminAddCouponComponent;
use App\Http\Livewire\Admin\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\AdminAddProductAttributeComponent;
use App\Http\Livewire\Admin\AdminContactUsComponent;
use App\Http\Livewire\Admin\AdminCouponsComponent;
use App\Http\Livewire\Admin\AdminEditCouponComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\AdminEditProduct;
use App\Http\Livewire\Admin\AdminEditProductAttributeComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminEditShop;
use App\Http\Livewire\Admin\AdminHomeCategoriesComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminManageShop;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminProductAttributesComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\Admin\AdminSettingsComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\OpenShop;
use App\Http\Livewire\PolicyComponent;
use App\Http\Livewire\ReturnPolicyComponent;
use App\Http\Livewire\TermsAndConditionsComponent;
use App\Http\Livewire\ThankyouComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;
use App\Http\Livewire\User\UserEditProfileComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserProfileComponent;
use App\Http\Livewire\User\UserReviewComponent;
use Illuminate\Support\Facades\Route;
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
Route::get('/', HomeComponent::class);
Route::get('/about', AboutComponent::class);
Route::get('/shop', ShopComponent::class);
Route::get('/open-shop', OpenShop::class)->name('new_shop');
Route::get('/cart', CartComponent::class)->name('product.cart');
Route::get('/checkout', CheckoutComponent::class)->name('checkout');
Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');
Route::get('/product-category/{category_slug}/{scategory_slug?}', CategoryComponent::class)->name('product.category');
Route::get('/search', SearchComponent::class)->name('product.search');
Route::get('/wishlist',WishlistComponent::class)->name('product.wishlist');
Route::get('/thank-you',ThankyouComponent::class)->name('thankyou');
Route::get('/contact-us',ContactComponent::class)->name('contactus');
Route::get('/return-policy',ReturnPolicyComponent::class)->name('retun_policy');
Route::get('/policy',PolicyComponent::class)->name('policy');
Route::get('/terms-conditions',TermsAndConditionsComponent::class)->name('termsandconditions');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');




// User Routes
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/user/history',UserComponent::class)->name('user.dashboard');
    Route::get('/user/orders',UserOrdersComponent::class)->name('user.orders');
    Route::get('/user/orders/{order_id}',UserOrderDetailsComponent::class)->name('user.orderdetails');
    Route::get('/user/review/{order_item_id}',UserReviewComponent::class)->name('user.review');
    Route::get('/user/change-password',UserChangePasswordComponent::class)->name('user.changepassword');
    Route::get('/user/profile',UserProfileComponent::class)->name('user.profile');
    Route::get('/user/profile/edit',UserEditProfileComponent::class)->name('user.editprofile');

});

// Admin routes
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function(){
    // admin show dashboard
   Route::get('/admin/dashboard',AdminComponent::class)->name('admin.dashboard');
//    Manage shops
   Route::get('/admin/shop',AdminManageShop::class)->name('admin.shops');
   Route::get('/admin/EditShop/{id}',AdminEditShop::class)->name('admin.editshop');
//    admin categories
   Route::get('/admin/categories',AdminCategoryComponent::class)->name('admin.categories');
   Route::get('/admin/category/Add',AdminAddCategoryComponent::class)->name('admin.Add');
   Route::get('/admin/category/Edit/{category_slug}/{scategory_slug?}',AdminEditCategoryComponent::class)->name('admin.Edit');
//    admin products
   Route::get('/admin/products',AdminProductComponent::class)->name('admin.products');
   Route::get('/admin/product/add',AddNewProductComponent::class)->name('admin.Addproduct');
   Route::get('/admin/product/EditProduct/{product_slug}',AdminEditProduct::class)->name('admin.editproduct');
//    admin HomeSlider
   Route::get('/admin/slider',AdminHomeSliderComponent::class)->name('admin.homeslider');
   Route::get('/admin/slider/add',AdminAddHomeSliderComponent::class)->name('admin.addhomeslider');
   Route::get('/admin/slider/edit/{slide_id}',AdminEditHomeSliderComponent::class)->name('admin.edithomeslider');

   Route::get('/admin/homeCategories',AdminHomeCategoriesComponent::class)->name('admin.homecategories');

   Route::get('/admin/sale',AdminSaleComponent::class)->name('admin.sale');
   //coupons
   Route::get('/admin/coupons',AdminCouponsComponent::class)->name('admin.coupons');
   Route::get('/admin/coupon/add',AdminAddCouponComponent::class)->name('admin.addcoupon');
   Route::get('/admin/coupon/edit/{coupon_id}',AdminEditCouponComponent::class)->name('admin.editcoupon');

//    orders
   Route::get('/admin/orders',AdminOrderComponent::class)->name('admin.orders');
   Route::get('/admin/orders/{order_id}',AdminOrderDetailsComponent::class)->name('admin.orderdetails');

//    contact-us
   Route::get('/admin/contacts',AdminContactUsComponent::class)->name('admin.contacts');
//    settings
   Route::get('/admin/settings',AdminSettingsComponent::class)->name('admin.settings');
//  Product Attributes
    Route::get('/admin/attributes',AdminProductAttributesComponent::class)->name('admin.attributes');
    Route::get('/admin/attributes/add',AdminAddProductAttributeComponent::class)->name('admin.add_attributes');
    Route::get('/admin/attributes/edit/{attribute_id}',AdminEditProductAttributeComponent::class)->name('admin.edit_attributes');
});


