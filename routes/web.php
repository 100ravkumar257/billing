<?php

use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\Retailer\RetailerController;


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


Route::get('setlocale/{locale}', function ($lang) {
	\Session::put('locale', $lang);
	return redirect()->back();
})->name('setlocale');
// Frontend Routes
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');


Route::get('retailer-shop/login', [App\Http\Controllers\Frontend\Retailer\SalespersonController::class, 'showLogin'])->name('retailer.shop.login');
Route::post('retailer-shop/login', [App\Http\Controllers\Frontend\Retailer\SalespersonController::class, 'login'])->name('retailer.shop.login.submit');
Route::get('retailer-shop/retailer-order-approve/{id}', [App\Http\Controllers\Frontend\Retailer\CartController::class, 'retailer_order_approve_frm'])->name('retailer.order.approve'); 
Route::get('retailer-shop/approve-order/{encryptedOrderId}/{encryptedRetailerId}', [App\Http\Controllers\Frontend\Retailer\CartController::class, 'approve_order'])->name('approve.order'); 
Route::get('retailer-shop/reject-order/{encryptedOrderId}/{encryptedRetailerId}', [App\Http\Controllers\Frontend\Retailer\CartController::class, 'reject_order'])->name('reject.order'); 



Route::middleware(['auth:salesperson'])->group(function () {
	Route::get('/retailer', [RetailerController::class, 'index'])->name('retailer');
	Route::post('/retailer/select', [RetailerController::class, 'get_retailer'])->name('retailer.select');
	Route::get('/retailer/verify', [RetailerController::class, 'show_verification_page'])->name('retailer.verify');
	Route::post('/retailer/verify', [RetailerController::class, 'verify_mobile'])->name('retailer.verify_mobile');
	Route::post('/retailer/verify/handle', [RetailerController::class, 'handle_verification'])->name('retailer.handle_verification');
	Route::get('/retailer/register', [RetailerController::class, 'showRegistrationForm'])->name('retailer.register');
	Route::post('/retailer/register', [RetailerController::class, 'register'])->name('retailer.register.submit');
	Route::get('/retailer/shop', [RetailerController::class, 'showShopPage'])->name('retailer.shop');
Route::post('/check-mobile-number', [RetailerController::class, 'checkMobileNumber']);
Route::post('/create-retailer', [RetailerController::class, 'createRetailer']);
	

	Route::post('/retailer-get', [RetailerController::class, 'get_retailer'])->name('retailer.get');
    Route::get('/retailer-shop', [App\Http\Controllers\Frontend\Retailer\ShopController::class, 'index'])->name('retailer.shop');
	Route::get('/retailer-shop/retailer-product-variants/{id}', [App\Http\Controllers\Frontend\Retailer\ShopController::class, 'getProductVariants'])->name('retailer.product.variants');
	
	Route::get('/retailer-shop/category/{slug}', [App\Http\Controllers\Frontend\Retailer\ShopController::class, 'getCategoryProducts']);
	
	Route::get('/retailer-shop/search', [App\Http\Controllers\Frontend\Retailer\ShopController::class, 'search'])->name('retailer.search');
	Route::get('/retailer-shop/product/{slug}', [App\Http\Controllers\Frontend\Retailer\ShopController::class, 'show'])->name('product.details');
 
	Route::post('/retailer-shop/add-to-cart', [App\Http\Controllers\Frontend\Retailer\CartController::class, 'addToCart']);
	Route::get('/retailer-shop/cart', [App\Http\Controllers\Frontend\Retailer\CartController::class, 'getCart']);
	Route::post('/retailer-shop/cart/update', [App\Http\Controllers\Frontend\Retailer\CartController::class, 'updateCart'])->name('retailer.cart.update');
	Route::post('/retailer-shop/cart/remove', [App\Http\Controllers\Frontend\Retailer\CartController::class, 'removeCartItem']);
	Route::get('/retailer-shop/cart-details', [App\Http\Controllers\Frontend\Retailer\CartController::class, 'cartDetails'])->name('retailer.cart.details');
	Route::get('/retailer-shop/save-cart-item', [App\Http\Controllers\Frontend\Retailer\CartController::class, 'saveCartItem'])->name('retailer.cart.saveitem');
	Route::get('/retailer-shop/order/success', [App\Http\Controllers\Frontend\Retailer\CartController::class, 'success'])->name('retailer.order.success');
	Route::get('/retailer-shop/pending-order', [App\Http\Controllers\Frontend\Retailer\OrderController::class, 'pending_order'])->name('retailer.pending.order');
	Route::get('/retailer-shop/pending-order-details/{encryptedOrderId}', [App\Http\Controllers\Frontend\Retailer\OrderController::class, 'pending_order_details'])->name('retailer.pending.order.details');
});


Route::post('/retailer-shop/logout', [App\Http\Controllers\Frontend\Retailer\SalespersonController::class, 'logout'])->name('retailer.shop.logout');


// Frontend Retailer Routes End

Route::post('/clear-retailer-session', function () {
    Session::forget('retailer_id');
    return response()->json(['message' => 'Session cleared']);
});
Route::group(['middleware' => 'language'], function () {

	// Admin Routes
	Route::prefix('admin')->group(function () {

		Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
		Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login_go'])->name('login_go');
		Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

		Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
		Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

		Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
		Route::post('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

		// Admin Authenticated Routes
		Route::group(['middleware' => ['auth']], function () {

			Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');

			// Profile
			Route::get('/profile', [App\Http\Controllers\Admin\UserController::class, 'profile'])->name('profile');
			Route::post('/profile/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'profile_update'])->name('profile.update');

			// User
			Route::prefix('users')->group(function () {
				Route::get('/index', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
				Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
				Route::post('/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
				Route::get('/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
				Route::post('/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
				Route::post('/destroy', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
				Route::get('/status_update', [App\Http\Controllers\Admin\UserController::class, 'status_update'])->name('users.status_update');
				Route::get('/get-parent-users-by-role', [App\Http\Controllers\Admin\UserController::class, 'getParentUsersByRole'])->name('users.getParentUsersByRole');
			});
			// Medicine Management
Route::prefix('medicines')->group(function () {
	Route::get('/', [App\Http\Controllers\Admin\MedicineController::class, 'index'])->name('medicines.index');
	Route::get('/create', [App\Http\Controllers\Admin\MedicineController::class, 'create'])->name('medicines.create');
	Route::post('/store', [App\Http\Controllers\Admin\MedicineController::class, 'store'])->name('medicines.store');
	Route::get('/edit/{medicine}', [App\Http\Controllers\Admin\MedicineController::class, 'edit'])->name('medicines.edit');
	Route::put('/update/{medicine}', [App\Http\Controllers\Admin\MedicineController::class, 'update'])->name('medicines.update');
	Route::delete('/destroy/{medicine}', [App\Http\Controllers\Admin\MedicineController::class, 'destroy'])->name('medicines.destroy');
});


			// Role
			Route::prefix('roles')->group(function () {
				Route::get('/index', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.index');
				Route::get('/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('roles.create');
				Route::post('/store', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store');
				Route::get('/edit/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('roles.edit');
				Route::post('/update/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('roles.update');
				Route::post('/destroy', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('roles.destroy');
				Route::get('/role/{role}/parent', [App\Http\Controllers\Admin\RoleController::class, 'getParentRole'])->name('getParentRole');
				Route::get('/status_update', [App\Http\Controllers\Admin\RoleController::class, 'status_update'])->name('roles.status_update');


			});

			// Permission
			Route::prefix('permissions')->group(function () {
				Route::get('/index', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions.index');
				Route::get('/create', [App\Http\Controllers\Admin\PermissionController::class, 'create'])->name('permissions.create');
				Route::post('/store', [App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('permissions.store');
				Route::get('/edit/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'edit'])->name('permissions.edit');
				Route::post('/update/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('permissions.update');
				Route::post('/destroy', [App\Http\Controllers\Admin\PermissionController::class, 'destroy'])->name('permissions.destroy');
			});

			// Currency
			Route::prefix('currencies')->group(function () {
				Route::get('/index', [App\Http\Controllers\Admin\CurrencyController::class, 'index'])->name('currencies.index');
				Route::get('/create', [App\Http\Controllers\Admin\CurrencyController::class, 'create'])->name('currencies.create');
				Route::post('/store', [App\Http\Controllers\Admin\CurrencyController::class, 'store'])->name('currencies.store');
				Route::get('/edit/{id}', [App\Http\Controllers\Admin\CurrencyController::class, 'edit'])->name('currencies.edit');
				Route::post('/update/{id}', [App\Http\Controllers\Admin\CurrencyController::class, 'update'])->name('currencies.update');
				Route::post('/destroy', [App\Http\Controllers\Admin\CurrencyController::class, 'destroy'])->name('currencies.destroy');
				Route::get('/status_update', [App\Http\Controllers\Admin\CurrencyController::class, 'status_update'])->name('currencies.status_update');
			});

			// Setting
			Route::prefix('setting')->group(function () {
				Route::get('/file-manager/index', [App\Http\Controllers\Admin\FileManagerController::class, 'index'])->name('filemanager.index');
				Route::get('/website-setting/edit', [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('website-setting.edit');
				Route::post('/website-setting/update/{id}', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('website-setting.update');
			});

			// CMS category
			// Route::prefix('categories')->group(function () {
			// 	Route::get('/index', [App\Http\Controllers\Admin\CMSCategoryController::class, 'index'])->name('categories.index');
			// 	Route::get('/create', [App\Http\Controllers\Admin\CMSCategoryController::class, 'create'])->name('categories.create');
			// 	Route::post('/store', [App\Http\Controllers\Admin\CMSCategoryController::class, 'store'])->name('categories.store');
			// 	Route::get('/edit/{id}', [App\Http\Controllers\Admin\CMSCategoryController::class, 'edit'])->name('categories.edit');
			// 	Route::post('/update/{id}', [App\Http\Controllers\Admin\CMSCategoryController::class, 'update'])->name('categories.update');
			// 	Route::post('/destroy', [App\Http\Controllers\Admin\CMSCategoryController::class, 'destroy'])->name('categories.destroy');
			// 	Route::get('/status_update', [App\Http\Controllers\Admin\CMSCategoryController::class, 'status_update'])->name('categories.status_update');
			// });
			// Order_ManagementController
			// routes/web.php

// routes/web.php

Route::prefix('Order_Management')->group(function () {
    Route::get('/index', [App\Http\Controllers\Admin\Order_ManagementController::class, 'index'])->name('Order_Management.index');
    Route::get('/create', [App\Http\Controllers\Admin\Order_ManagementController::class, 'create'])->name('Order_Management.create');
    Route::post('/store', [App\Http\Controllers\Admin\Order_ManagementController::class, 'store'])->name('Order_Management.store');	
    Route::get('/edit/{id}', [App\Http\Controllers\Admin\Order_ManagementController::class, 'edit'])->name('Order_Management.edit');
    Route::post('/update/{id}', [App\Http\Controllers\Admin\Order_ManagementController::class, 'update'])->name('Order_Management.update');
    Route::post('/destroy', [App\Http\Controllers\Admin\Order_ManagementController::class, 'destroy'])->name('Order_Management.destroy');
	Route::get('/{order}/details', [App\Http\Controllers\Admin\Order_ManagementController::class, 'showDetails'])->name('Order_Management.details');


	Route::get('/status_update', [App\Http\Controllers\Admin\Order_ManagementController::class, 'status_update'])->name('Order_Management.status_update');
});

			// CMS Pages
			Route::prefix('cmspages')->group(function () {
				Route::get('/index', [App\Http\Controllers\Admin\CMSPageController::class, 'index'])->name('cmspages.index');
				Route::get('/create', [App\Http\Controllers\Admin\CMSPageController::class, 'create'])->name('cmspages.create');
				Route::post('/store', [App\Http\Controllers\Admin\CMSPageController::class, 'store'])->name('cmspages.store');
				Route::get('/edit/{id}', [App\Http\Controllers\Admin\CMSPageController::class, 'edit'])->name('cmspages.edit');
				Route::post('/update/{id}', [App\Http\Controllers\Admin\CMSPageController::class, 'update'])->name('cmspages.update');
				Route::post('/destroy', [App\Http\Controllers\Admin\CMSPageController::class, 'destroy'])->name('cmspages.destroy');
				Route::get('/status_update', [App\Http\Controllers\Admin\CMSPageController::class, 'status_update'])->name('cmspages.status_update');
			});
			Route::prefix('products')->group(function () {
				Route::get('/index', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
				Route::get('/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('products.create');
				Route::post('/store', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
				Route::get('/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
				Route::post('/update/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
				Route::post('/destroy', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');
				Route::get('/status_update', [App\Http\Controllers\Admin\ProductController::class, 'status_update'])->name('products.status_update');
			});
			Route::prefix('brands')->group(function () {
				Route::get('/index', [App\Http\Controllers\Admin\BrandController::class, 'index'])->name('brands.index');
				Route::get('/create', [App\Http\Controllers\Admin\BrandController::class, 'create'])->name('brands.create');
				Route::post('/store', [App\Http\Controllers\Admin\BrandController::class, 'store'])->name('brands.store');
				Route::get('/edit/{id}', [App\Http\Controllers\Admin\BrandController::class, 'edit'])->name('brands.edit');
				Route::post('/update/{id}', [App\Http\Controllers\Admin\BrandController::class, 'update'])->name('brands.update');
				Route::post('/destroy', [App\Http\Controllers\Admin\BrandController::class, 'destroy'])->name('brands.destroy');
				Route::get('/status_update', [App\Http\Controllers\Admin\BrandController::class, 'status_update'])->name('brands.status_update');
			});

			// Testimonials
			Route::prefix('testimonials')->group(function () {
				Route::get('/index', [App\Http\Controllers\Admin\TestimonialController::class, 'index'])->name('testimonials.index');
				Route::get('/create', [App\Http\Controllers\Admin\TestimonialController::class, 'create'])->name('testimonials.create');
				Route::post('/store', [App\Http\Controllers\Admin\TestimonialController::class, 'store'])->name('testimonials.store');
				Route::get('/edit/{id}', [App\Http\Controllers\Admin\TestimonialController::class, 'edit'])->name('testimonials.edit');
				Route::post('/update/{id}', [App\Http\Controllers\Admin\TestimonialController::class, 'update'])->name('testimonials.update');
				Route::post('/destroy', [App\Http\Controllers\Admin\TestimonialController::class, 'destroy'])->name('testimonials.destroy');
				Route::get('/status_update', [App\Http\Controllers\Admin\TestimonialController::class, 'status_update'])->name('testimonials.status_update');
			});

			Route::prefix('hierarchy')->group(function () {
				Route::get('/create', [App\Http\Controllers\Admin\HierarchyController::class, 'create'])->name('hierarchy.create');
				Route::post('/', [App\Http\Controllers\Admin\HierarchyController::class, 'store'])->name('hierarchy.store');
				Route::get('/get-parents/{roleId}', [App\Http\Controllers\Admin\HierarchyController::class, 'getParents'])->name('hierarchy.getParents');


			});
			Route::prefix('Product_variants')->group(function () {
				Route::get('/create', [App\Http\Controllers\Admin\ProductVariantController::class, 'create'])->name('Product_variants.create');
				Route::post('/index', [App\Http\Controllers\Admin\ProductVariantController::class, 'store'])->name('Product_variants.store');

			});


			Route::prefix('categories')->group(function () {
				Route::get('/index', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'index'])->name('categories.index');
				Route::get('/create', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'create'])->name('categories.create');
				Route::post('/store', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'store'])->name('categories.store');
				Route::get('/edit/{id}', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'edit'])->name('categories.edit');
				Route::post('/update/{id}', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'update'])->name('categories.update');
				Route::post('/destroy', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'destroy'])->name('categories.destroy');
				Route::get('/status_update', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'status_update'])->name('categories.status_update');
			});

			Route::prefix('brands')->group(function () {
				Route::get('/index', [App\Http\Controllers\Admin\BrandController::class, 'index'])->name('brands.index');
				Route::get('/create', [App\Http\Controllers\Admin\BrandController::class, 'create'])->name('brands.create');
				Route::post('/store', [App\Http\Controllers\Admin\BrandController::class, 'store'])->name('brands.store');
				Route::get('/edit/{id}', [App\Http\Controllers\Admin\BrandController::class, 'edit'])->name('brands.edit');
				Route::post('/update/{id}', [App\Http\Controllers\Admin\BrandController::class, 'update'])->name('brands.update');
				Route::post('/destroy', [App\Http\Controllers\Admin\BrandController::class, 'destroy'])->name('brands.destroy');
				Route::get('/status_update', [App\Http\Controllers\Admin\BrandController::class, 'status_update'])->name('brands.status_update');
			});

			Route::prefix('shades')->group(function () {
				Route::get('/index', [App\Http\Controllers\Admin\ShadesController::class, 'index'])->name('shades.index');
				Route::get('/create', [App\Http\Controllers\Admin\ShadesController::class, 'create'])->name('shades.create');
				Route::post('/store', [App\Http\Controllers\Admin\ShadesController::class, 'store'])->name('shades.store');
				Route::get('/edit/{id}', [App\Http\Controllers\Admin\ShadesController::class, 'edit'])->name('shades.edit');
				Route::post('/update/{id}', [App\Http\Controllers\Admin\ShadesController::class, 'update'])->name('shades.update');
				Route::post('/destroy', [App\Http\Controllers\Admin\ShadesController::class, 'destroy'])->name('shades.destroy');
				Route::get('/status_update', [App\Http\Controllers\Admin\ShadesController::class, 'status_update'])->name('shades.status_update');
			});

			Route::prefix('packaging-types')->group(function () {
				Route::get('/index', [App\Http\Controllers\Admin\PackagingTypesController::class, 'index'])->name('packaging-types.index');
				Route::get('/create', [App\Http\Controllers\Admin\PackagingTypesController::class, 'create'])->name('packaging-types.create');
				Route::post('/store', [App\Http\Controllers\Admin\PackagingTypesController::class, 'store'])->name('packaging-types.store');
				Route::get('/edit/{id}', [App\Http\Controllers\Admin\PackagingTypesController::class, 'edit'])->name('packaging-types.edit');
				Route::post('/update/{id}', [App\Http\Controllers\Admin\PackagingTypesController::class, 'update'])->name('packaging-types.update');
				Route::post('/destroy', [App\Http\Controllers\Admin\PackagingTypesController::class, 'destroy'])->name('packaging-types.destroy');
				Route::get('/status_update', [App\Http\Controllers\Admin\PackagingTypesController::class, 'status_update'])->name('packaging-types.status_update');
			});

			Route::prefix('products')->group(function () {
				Route::get('/index', [App\Http\Controllers\Admin\ProductsController::class, 'index'])->name('products.index');
				Route::get('/create', [App\Http\Controllers\Admin\ProductsController::class, 'create'])->name('products.create');
				Route::post('/store', [App\Http\Controllers\Admin\ProductsController::class, 'store'])->name('products.store');
				Route::get('/edit/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'edit'])->name('products.edit');
				Route::post('/update/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'update'])->name('products.update');
				Route::post('/destroy', [App\Http\Controllers\Admin\ProductsController::class, 'destroy'])->name('products.destroy');
				Route::get('/status_update', [App\Http\Controllers\Admin\ProductsController::class, 'status_update'])->name('products.status_update');
				Route::get('/{product}/create_variant', [App\Http\Controllers\Admin\ProductsController::class, 'createVariant'])->name('products.variants');
				Route::post('/{product}/variant/store', [App\Http\Controllers\Admin\ProductsController::class, 'storeVariant'])->name('products.variant.store');
				Route::put('/{product}/variant/{variant}', [App\Http\Controllers\Admin\ProductsController::class, 'updateVariant'])->name('products.variant.update');
				Route::delete('/{product}/variant/{variant}', [App\Http\Controllers\Admin\ProductsController::class, 'destroyVariant'])->name('products.variant.destroy');


			});
		});
	});

});

