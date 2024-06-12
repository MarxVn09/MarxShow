<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartSiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionAdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductSiteController;
use App\Http\Controllers\RoleAdminController;
use App\Http\Controllers\SettingAdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SliderAdminController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserNormalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;


Route::prefix('/')->group(function () {
    Route::get('/', [SiteController::class, 'index'])->name('/');
    Route::get('/forget-password', [ForgetPasswordController::class, 'forgetPassword'])->name('forget.password');
    Route::post('/forget-password', [ForgetPasswordController::class, 'forgetPasswordPost'])->name('forget.password.post');
    Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('reset.password');
    Route::post('/reset-password', [ForgetPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');

    Route::prefix('login')->group(function () {
        Route::get('/', [UserNormalController::class, 'loginForm'])->name('login.form');
        Route::post('/', [UserNormalController::class, 'login'])->name('login.post');
        Route::get('/resister', [UserNormalController::class, 'resisterForm'])->name('resister.form');
        Route::post('/resister', [UserNormalController::class, 'resister'])->name('resister.post');
        Route::get('/logout', [UserNormalController::class, 'logout'])->name('logoutSite');
    });
    Route::middleware(['loginCheck'])->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', [UserNormalController::class, 'profile'])->name('user.profile');
            Route::get('/change-password', [UserNormalController::class, 'changePass'])->name('user.changePass');
            Route::post('/change-password', [UserNormalController::class, 'changePassPost'])->name('user.changePass.post');
            Route::get('/order', [UserNormalController::class, 'order'])->name('user.order');
            Route::get('/order/{id}', [UserNormalController::class, 'orderDetail'])->name('user.order.detail');
            Route::get('order/check/{id}',[UserNormalController::class, 'orderCheck'])->name('order.checked');

        });
        Route::prefix('cart')->group(function () {
            Route::get('/', [CartSiteController::class, 'index'])->name('cart.index');
            Route::post('/add-to-cart',[CartSiteController::class,'addToCart'])->name('cart.add');
            Route::post('/update-cart', [CartSiteController::class, 'updateCart'])->name('cart.update');
            Route::post('/remove-cart-item', [CartSiteController::class, 'removeCartItem'])->name('cart.remove');
            Route::get('/check-out', [CartSiteController::class, 'checkOut'])->name('cart.checkOut');
            Route::post('/check-out', [CartSiteController::class, 'checkOutPost'])->name('cart.checkOut.post');

        });
    });

    Route::prefix('shop')->group(function () {
        Route::get('/', [ShopController::class, 'index'])->name('shop.index');
        Route::get('/{slug}', [ShopController::class, 'getByCategory'])->name('shop.product');
    });
    Route::prefix('product')->group(function () {
        Route::get('/detail/{id}', [ProductSiteController::class, 'productDetail'])->name('product.detail');
    });

    Route::prefix('post')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('post.index');
        Route::get('/byView', [PostController::class, 'byView'])->name('post.view');
        Route::get('/new', [PostController::class, 'new'])->name('post.new');
        Route::get('/byCat/{id}', [PostController::class, 'byCat'])->name('post.cat');
        Route::get('/detail/{id}', [PostController::class, 'detail'])->name('post.detail');
    });
});


Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'loginAdmin'])->name('loginAdmin');
    Route::post('/', [AdminController::class, 'postLoginAdmin']);
    Route::get('/logout', [AdminController::class, 'logoutAdmin'])->name('logoutAmin');
    Route::get('/home', [AdminController::class, 'home'])->name('admin.home');
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index')->middleware('can:category-list');
        Route::get('/creat', [CategoryController::class, 'creat'])->name('categories.creat')->middleware('can:category-add');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store')->middleware('can:category-add');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('can:category-edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('categories.update')->middleware('can:category-edit');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete')->middleware('can:category-delete');
    });
    Route::prefix('menus')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('menus.index')->middleware('can:menu-list');
        Route::get('/creat', [MenuController::class, 'creat'])->name('menus.creat')->middleware('can:menu-add');
        Route::post('/store', [MenuController::class, 'store'])->name('menus.store')->middleware('can:menu-add');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menus.edit')->middleware('can:menu-edit');
        Route::post('/update/{id}', [MenuController::class, 'update'])->name('menus.update')->middleware('can:menu-edit');
        Route::get('/delete/{id}', [MenuController::class, 'delete'])->name('menus.delete')->middleware('can:menu-delete');
    });
    Route::prefix('product')->group(function () {
        Route::get('/', [AdminProductController::class, 'index'])->name('product.index')->middleware('can:product-list');
        Route::get('/creat', [AdminProductController::class, 'creat'])->name('product.creat')->middleware('can:product-add');
        Route::post('/store', [AdminProductController::class, 'store'])->name('product.store')->middleware('can:product-add');
        Route::get('/edit/{id}', [AdminProductController::class, 'edit'])->name('product.edit')->middleware('can:product-edit,id');
        Route::post('/update/{id}', [AdminProductController::class, 'update'])->name('product.update')->middleware('can:product-edit,id');
        Route::get('/delete/{id}', [AdminProductController::class, 'delete'])->name('product.delete')->middleware('can:product-delete');
    });
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::get('/view/{id}', [OrderController::class, 'view'])->name('order.view');
        Route::get('/change/{id}', [OrderController::class, 'change'])->name('order.change');
    });
    Route::prefix('sliders')->group(function () {
        Route::get('/', [SliderAdminController::class, 'index'])->name('sliders.index')->middleware('can:slider-list');
        Route::get('/creat', [SliderAdminController::class, 'creat'])->name('sliders.creat')->middleware('can:slider-add');
        Route::post('/store', [SliderAdminController::class, 'store'])->name('sliders.store')->middleware('can:slider-add');
        Route::get('/edit/{id}', [SliderAdminController::class, 'edit'])->name('sliders.edit')->middleware('can:slider-edit');
        Route::post('/update/{id}', [SliderAdminController::class, 'update'])->name('sliders.update')->middleware('can:slider-edit');
        Route::get('/delete/{id}', [SliderAdminController::class, 'delete'])->name('sliders.delete')->middleware('can:slider-delete');
    });
    Route::prefix('setting')->group(function () {
        Route::get('/', [SettingAdminController::class, 'index'])->name('setting.index')->middleware('can:setting-list');
        Route::get('/creat', [SettingAdminController::class, 'creat'])->name('setting.creat')->middleware('can:setting-add');
        Route::post('/store', [SettingAdminController::class, 'store'])->name('setting.store')->middleware('can:setting-add');
        Route::get('/edit/{id}', [SettingAdminController::class, 'edit'])->name('setting.edit')->middleware('can:setting-edit');
        Route::post('/update/{id}', [SettingAdminController::class, 'update'])->name('setting.update')->middleware('can:setting-edit');
        Route::get('/delete/{id}', [SettingAdminController::class, 'delete'])->name('setting.delete')->middleware('can:setting-delete');
    });
    Route::prefix('users')->group(function () {
        Route::get('/', [UserAdminController::class, 'index'])->name('users.index')->middleware('can:user-list');
        Route::get('/creat', [UserAdminController::class, 'creat'])->name('users.creat')->middleware('can:user-add');
        Route::post('/store', [UserAdminController::class, 'store'])->name('users.store')->middleware('can:user-add');
        Route::get('/edit/{id}', [UserAdminController::class, 'edit'])->name('users.edit')->middleware('can:user-edit');
        Route::post('/update/{id}', [UserAdminController::class, 'update'])->name('users.update')->middleware('can:user-edit');
        Route::get('/delete/{id}', [UserAdminController::class, 'delete'])->name('users.delete')->middleware('can:user-delete');
    });
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleAdminController::class, 'index'])->name('roles.index')->middleware('can:role-list');
        Route::get('/creat', [RoleAdminController::class, 'creat'])->name('roles.creat')->middleware('can:role-add');
        Route::post('/store', [RoleAdminController::class, 'store'])->name('roles.store')->middleware('can:role-add');
        Route::get('/edit/{id}', [RoleAdminController::class, 'edit'])->name('roles.edit')->middleware('can:role-edit');
        Route::post('/update/{id}', [RoleAdminController::class, 'update'])->name('roles.update')->middleware('can:role-edit');
        Route::get('/delete/{id}', [RoleAdminController::class, 'delete'])->name('roles.delete')->middleware('can:role-delete');
    });
    Route::prefix('permission')->group(function () {
        Route::get('/creat', [PermissionAdminController::class, 'permissionCreate'])->name('permission.creatPermission');
        Route::post('/store', [PermissionAdminController::class, 'permissionStore'])->name('permission.storePermission');
    });
    Route::prefix('banner')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('banner.index');
        Route::get('/creat', [BannerController::class, 'creat'])->name('banner.creat');
        Route::post('/store', [BannerController::class, 'store'])->name('banner.store');
        Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
        Route::post('/update/{id}', [BannerController::class, 'update'])->name('banner.update');
        Route::get('/delete/{id}', [BannerController::class, 'delete'])->name('banner.delete');
    });
});


