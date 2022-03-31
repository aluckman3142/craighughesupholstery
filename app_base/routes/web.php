<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\CategoryImageController;
use App\Http\Controllers\BeforeAfterController;
use App\Http\Controllers\AccommodationImageController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\UpholsteryClassEnquiryController;
use App\Http\Controllers\FabricLinkController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/about-us', [HomeController::class, 'about']);
Route::get('/accommodation', [HomeController::class, 'accommodation']);
Route::get('/fabrics', [HomeController::class, 'fabrics']);
Route::get('/upholstery-classes', [HomeController::class, 'upholsteryClasses']);
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/videos', [HomeController::class, 'videos']);
Route::get('/news', [HomeController::class, 'news']);
Route::get('/news/{post}', [PostController::class, 'show']);
Route::post('/enquiry/store', [EnquiryController::class, 'store']);
Route::get('reload-captcha-enquiry', [EnquiryController::class, 'reloadCaptcha']);
Route::post('/upholstery-class-enquiry/store', [UpholsteryClassEnquiryController::class, 'store']);
Route::get('reload-captcha-upholstery-enquiry', [UpholsteryClassEnquiryController::class, 'reloadCaptcha']);
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy-policy');
Route::get('/returns-policy', [HomeController::class, 'returns'])->name('returns-policy');


/*SHOP ROUTES*/

Route::get('/shop', [HomeController::class, 'shop'])->name('shop.index');
Route::get('/shop/{product}', [ProductController::class, 'show'])->name('shop.product');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware(['auth']);
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/guest-checkout', [CheckoutController::class, 'index'])->name('guest-checkout.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/empty', [CartController::class, 'empty'])->name('cart.empty');
Route::get('/thankyou', [HomeController::class, 'thankyou'])->name('thankyou');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('cart/switchToSaveForLater/{product}', [CartController::class, 'switchToSaveForLater'])->name('cart.switchToSaveForLater');
Route::post('cart/moveToCart/{product}', [CartController::class, 'moveToCart'])->name('cart.moveToCart');


/*ACCOUNT ROUTES*/

Route::get('/my-account', [AccountController::class, 'index'])->middleware(['auth','user'])->name('my-account');


/*DASHBOARD ROUTES*/

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth','admin'])->name('dashboard');

Route::get('/dashboard/menu-items', [MenuItemController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.menu-items');
Route::get('/dashboard/menu-items/create', [MenuItemController::class, 'create'])->middleware(['auth','admin'])->name('dashboard.menu-items.create');
Route::post('/dashboard/menu-items/store', [MenuItemController::class, 'store'])->middleware(['auth','admin'])->name('dashboard.menu-items.store');
Route::delete('/dashboard/menu-items/{menuItem}', [MenuItemController::class, 'destroy'])->middleware(['auth','admin'])->name('dashboard.menu-items.destroy');
Route::get('/dashboard/menu-items/{menuItem}/edit', [MenuItemController::class, 'edit'])->middleware(['auth','admin'])->name('dashboard.menu-items.edit');
Route::post('/dashboard/menu-items/{menuItem}/update', [MenuItemController::class, 'update'])->middleware(['auth','admin'])->name('dashboard.menu-items.update');
Route::post('/dashboard/menu-items/sort',[MenuItemController::class, 'sort'])->middleware(['auth','admin'])->name('dashboard.menu-items.sort');
Route::post('/dashboard/menu-items/{menuItem}/enable', [MenuItemController::class, 'enable'])->middleware(['auth','admin'])->name('dashboard.menu-items.enable');
Route::post('/dashboard/menu-items/{menuItem}/disable', [MenuItemController::class, 'disable'])->middleware(['auth','admin'])->name('dashboard.menu-items.disable');

Route::get('/dashboard/enquiries', [EnquiryController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.enquiries');
Route::delete('/dashboard/enquiries/{enquiry}', [EnquiryController::class, 'destroy'])->middleware(['auth','admin'])->name('dashboard.enquiries.destroy');
Route::get('/dashboard/enquiries/{enquiry}', [EnquiryController::class, 'show'])->middleware(['auth','admin'])->name('dashboard.enquiries.show');

Route::get('/dashboard/upholstery-enquiries', [UpholsteryClassEnquiryController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.upholstery-enquiries');
Route::delete('/dashboard/upholstery-enquiries/{upholsteryEnquiry}', [UpholsteryClassEnquiryController::class, 'destroy'])->middleware(['auth','admin'])->name('dashboard.upholstery-enquiries.destroy');
Route::get('/dashboard/upholstery-enquiries/{upholsteryEnquiry}', [UpholsteryClassEnquiryController::class, 'show'])->middleware(['auth','admin'])->name('dashboard.upholstery-enquiries.show');

Route::get('/dashboard/posts', [PostController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.posts');
Route::get('/dashboard/posts/create', [PostController::class, 'create'])->middleware(['auth','admin'])->name('dashboard.posts.create');
Route::post('/dashboard/posts/store', [PostController::class, 'store'])->middleware(['auth','admin'])->name('dashboard.posts.store');
Route::delete('/dashboard/posts/{post}', [PostController::class, 'destroy'])->middleware(['auth','admin'])->name('dashboard.posts.destroy');
Route::get('/dashboard/posts/{post}/edit', [PostController::class, 'edit'])->middleware(['auth','admin'])->name('dashboard.posts.edit');
Route::post('/dashboard/posts/{post}/update', [PostController::class, 'update'])->middleware(['auth','admin'])->name('dashboard.posts.update');
Route::post('/dashboard/posts/{post}/enable', [PostController::class, 'enable'])->middleware(['auth','admin'])->name('dashboard.posts.enable');
Route::post('/dashboard/posts/{post}/disable', [PostController::class, 'disable'])->middleware(['auth','admin'])->name('dashboard.posts.disable');

Route::get('/dashboard/categories', [CategoryController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.categories');
Route::get('/dashboard/categories/create', [CategoryController::class, 'create'])->middleware(['auth','admin'])->name('dashboard.categories.create');
Route::post('/dashboard/categories/store', [CategoryController::class, 'store'])->middleware(['auth','admin'])->name('dashboard.categories.store');
Route::post('/dashboard/categories/crop', [CategoryController::class, 'crop'])->middleware(['auth','admin'])->name('dashboard.categories.crop');
Route::delete('/dashboard/categories/{category}', [CategoryController::class, 'destroy'])->middleware(['auth','admin'])->name('dashboard.categories.destroy');
Route::get('/dashboard/categories/{category}/edit', [CategoryController::class, 'edit'])->middleware(['auth','admin'])->name('dashboard.categories.edit');
Route::post('/dashboard/categories/{category}/update', [CategoryController::class, 'update'])->middleware(['auth','admin'])->name('dashboard.categories.update');
Route::post('/dashboard/categories/sort',[CategoryController::class, 'sort'])->middleware(['auth','admin'])->name('dashboard.categories.sort');
Route::post('/dashboard/categories/{category}/enable', [CategoryController::class, 'enable'])->middleware(['auth','admin'])->name('dashboard.categories.enable');
Route::post('/dashboard/categories/{category}/disable', [CategoryController::class, 'disable'])->middleware(['auth','admin'])->name('dashboard.categories.disable');

Route::get('/dashboard/testimonials', [TestimonialController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.testimonials');
Route::get('/dashboard/testimonials/create', [TestimonialController::class, 'create'])->middleware(['auth','admin'])->name('dashboard.testimonials.create');
Route::post('/dashboard/testimonials/store', [TestimonialController::class, 'store'])->middleware(['auth','admin'])->name('dashboard.testimonials.store');
Route::post('/dashboard/testimonials/crop', [TestimonialController::class, 'crop'])->middleware(['auth','admin'])->name('dashboard.testimonials.crop');
Route::delete('/dashboard/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->middleware(['auth','admin'])->name('dashboard.testimonials.destroy');
Route::get('/dashboard/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->middleware(['auth','admin'])->name('dashboard.testimonials.edit');
Route::post('/dashboard/testimonials/{testimonial}/update', [TestimonialController::class, 'update'])->middleware(['auth','admin'])->name('dashboard.testimonials.update');
Route::post('/dashboard/testimonials/sort',[TestimonialController::class, 'sort'])->middleware(['auth','admin'])->name('dashboard.testimonials.sort');
Route::post('/dashboard/testimonials/{testimonial}/enable', [TestimonialController::class, 'enable'])->middleware(['auth','admin'])->name('dashboard.testimonials.enable');
Route::post('/dashboard/testimonials/{testimonial}/disable', [TestimonialController::class, 'disable'])->middleware(['auth','admin'])->name('dashboard.testimonials.disable');

Route::get('/dashboard/category-images', [CategoryImageController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.category-images');
Route::get('/dashboard/category-images/create', [CategoryImageController::class, 'create'])->middleware(['auth','admin'])->name('dashboard.category-images.create');
Route::post('/dashboard/category-images/store', [CategoryImageController::class, 'store'])->middleware(['auth','admin'])->name('dashboard.category-images.store');
Route::post('/dashboard/category-images/crop', [CategoryImageController::class, 'crop'])->middleware(['auth','admin'])->name('dashboard.category-images.crop');
Route::delete('/dashboard/category-images/{categoryImage}', [CategoryImageController::class, 'destroy','admin'])->middleware(['auth'])->name('dashboard.category-images.destroy');
Route::get('/dashboard/category-images/{categoryImage}/edit', [CategoryImageController::class, 'edit','admin'])->middleware(['auth'])->name('dashboard.category-images.edit');
Route::post('/dashboard/category-images/{categoryImage}/update', [CategoryImageController::class, 'update','admin'])->middleware(['auth'])->name('dashboard.category-images.update');
Route::post('/dashboard/category-images/sort',[CategoryImageController::class, 'sort'])->middleware(['auth','admin'])->name('dashboard.category-images.sort');
Route::post('/dashboard/category-images/{categoryImage}/enable', [CategoryImageController::class, 'enable','admin'])->middleware(['auth'])->name('dashboard.category-images.enable');
Route::post('/dashboard/category-images/{categoryImage}/disable', [CategoryImageController::class, 'disable','admin'])->middleware(['auth'])->name('dashboard.category-images.disable');

Route::get('/dashboard/before-after', [BeforeAfterController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.before-after');
Route::get('/dashboard/before-after/create', [BeforeAfterController::class, 'create'])->middleware(['auth','admin'])->name('dashboard.before-after.create');
Route::post('/dashboard/before-after/store', [BeforeAfterController::class, 'store'])->middleware(['auth','admin'])->name('dashboard.before-after.store');
Route::post('/dashboard/before-after/beforeCrop', [BeforeAfterController::class, 'beforeCrop'])->middleware(['auth','admin'])->name('dashboard.before-after.beforeCrop');
Route::post('/dashboard/before-after/afterCrop', [BeforeAfterController::class, 'afterCrop'])->middleware(['auth','admin'])->name('dashboard.before-after.afterCrop');
Route::delete('/dashboard/before-after/{beforeAfter}', [BeforeAfterController::class, 'destroy','admin'])->middleware(['auth'])->name('dashboard.before-after.destroy');
Route::get('/dashboard/before-after/{beforeAfter}/edit', [BeforeAfterController::class, 'edit','admin'])->middleware(['auth'])->name('dashboard.before-after.edit');
Route::post('/dashboard/before-after/{beforeAfter}/update', [BeforeAfterController::class, 'update','admin'])->middleware(['auth'])->name('dashboard.before-after.update');
Route::post('/dashboard/before-after/sort',[BeforeAfterController::class, 'sort'])->middleware(['auth','admin'])->name('dashboard.before-after.sort');
Route::post('/dashboard/before-after/{beforeAfter}/enable', [BeforeAfterController::class, 'enable','admin'])->middleware(['auth'])->name('dashboard.before-after.enable');
Route::post('/dashboard/before-after/{beforeAfter}/disable', [BeforeAfterController::class, 'disable','admin'])->middleware(['auth'])->name('dashboard.before-after.disable');

Route::get('/dashboard/accommodation-images', [AccommodationImageController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.accommodation-images');
Route::get('/dashboard/accommodation-images/create', [AccommodationImageController::class, 'create'])->middleware(['auth','admin'])->name('dashboard.accommodation-images.create');
Route::post('/dashboard/accommodation-images/store', [AccommodationImageController::class, 'store'])->middleware(['auth','admin'])->name('dashboard.accommodation-images.store');
Route::post('/dashboard/accommodation-images/crop', [AccommodationImageController::class, 'crop'])->middleware(['auth','admin'])->name('dashboard.accommodation-images.crop');
Route::delete('/dashboard/accommodation-images/{accommodationImage}', [AccommodationImageController::class, 'destroy'])->middleware(['auth','admin'])->name('dashboard.accommodation-images.destroy');
Route::get('/dashboard/accommodation-images/{accommodationImage}/edit', [AccommodationImageController::class, 'edit'])->middleware(['auth','admin'])->name('dashboard.accommodation-images.edit');
Route::post('/dashboard/accommodation-images/{accommodationImage}/update', [AccommodationImageController::class, 'update'])->middleware(['auth','admin'])->name('dashboard.accommodation-images.update');
Route::post('/dashboard/accommodation-images/sort',[AccommodationImageController::class, 'sort'])->middleware(['auth','admin'])->name('dashboard.accommodation-images.sort');
Route::post('/dashboard/accommodation-images/{accommodationImage}/enable', [AccommodationImageController::class, 'enable'])->middleware(['auth','admin'])->name('dashboard.accommodation-images.enable');
Route::post('/dashboard/accommodation-images/{accommodationImage}/disable', [AccommodationImageController::class, 'disable'])->middleware(['auth','admin'])->name('dashboard.accommodation-images.disable');

Route::get('/dashboard/sliders', [SliderController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.sliders');
Route::get('/dashboard/sliders/create', [SliderController::class, 'create'])->middleware(['auth','admin'])->name('dashboard.sliders.create');
Route::post('/dashboard/sliders/store', [SliderController::class, 'store'])->middleware(['auth','admin'])->name('dashboard.sliders.store');
Route::post('/dashboard/sliders/crop', [SliderController::class, 'crop'])->middleware(['auth','admin'])->name('dashboard.sliders.crop');
Route::delete('/dashboard/sliders/{slider}', [SliderController::class, 'destroy'])->middleware(['auth','admin'])->name('dashboard.sliders.destroy');
Route::get('/dashboard/sliders/{slider}/edit', [SliderController::class, 'edit'])->middleware(['auth','admin'])->name('dashboard.sliders.edit');
Route::post('/dashboard/sliders/{slider}/update', [SliderController::class, 'update'])->middleware(['auth','admin'])->name('dashboard.sliders.update');
Route::post('/dashboard/sliders/sort',[SliderController::class, 'sort'])->middleware(['auth','admin'])->name('dashboard.sliders.sort');
Route::post('/dashboard/sliders/{slider}/enable', [SliderController::class, 'enable'])->middleware(['auth','admin'])->name('dashboard.sliders.enable');
Route::post('/dashboard/sliders/{slider}/disable', [SliderController::class, 'disable'])->middleware(['auth','admin'])->name('dashboard.sliders.disable');

Route::get('/dashboard/fabric-links', [FabricLinkController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.fabric-links');
Route::get('/dashboard/fabric-links/create', [FabricLinkController::class, 'create'])->middleware(['auth','admin'])->name('dashboard.fabric-links.create');
Route::post('/dashboard/fabric-links/store', [FabricLinkController::class, 'store'])->middleware(['auth','admin'])->name('dashboard.fabric-links.store');
Route::delete('/dashboard/fabric-links/{fabricLink}', [FabricLinkController::class, 'destroy'])->middleware(['auth','admin'])->name('dashboard.fabric-links.destroy');
Route::get('/dashboard/fabric-links/{fabricLink}/edit', [FabricLinkController::class, 'edit'])->middleware(['auth','admin'])->name('dashboard.fabric-links.edit');
Route::post('/dashboard/fabric-links/{fabricLink}/update', [FabricLinkController::class, 'update'])->middleware(['auth','admin'])->name('dashboard.fabric-links.update');
Route::post('/dashboard/fabric-links/sort',[FabricLinkController::class, 'sort'])->middleware(['auth','admin'])->name('dashboard.fabric-links.sort');
Route::post('/dashboard/fabric-links/{fabricLink}/enable', [FabricLinkController::class, 'enable'])->middleware(['auth','admin'])->name('dashboard.fabric-links.enable');
Route::post('/dashboard/fabric-links/{fabricLink}/disable', [FabricLinkController::class, 'disable'])->middleware(['auth','admin'])->name('dashboard.fabric-links.disable');

Route::get('/dashboard/products', [ProductController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.products');
Route::get('/dashboard/products/create', [ProductController::class, 'create'])->middleware(['auth','admin'])->name('dashboard.products.create');
Route::post('/dashboard/products/store', [ProductController::class, 'store'])->middleware(['auth','admin'])->name('dashboard.products.store');
Route::delete('/dashboard/products/{product}', [ProductController::class, 'destroy'])->middleware(['auth','admin'])->name('dashboard.products.destroy');
Route::get('/dashboard/products/{product}/edit', [ProductController::class, 'edit'])->middleware(['auth','admin'])->name('dashboard.products.edit');
Route::post('/dashboard/products/{product}/update', [ProductController::class, 'update'])->middleware(['auth','admin'])->name('dashboard.products.update');
Route::post('/dashboard/products/sort',[ProductController::class, 'sort'])->middleware(['auth','admin'])->name('dashboard.products.sort');
Route::post('/dashboard/products/{product}/enable', [ProductController::class, 'enable'])->middleware(['auth','admin'])->name('dashboard.products.enable');
Route::post('/dashboard/products/{product}/disable', [ProductController::class, 'disable'])->middleware(['auth','admin'])->name('dashboard.products.disable');

Route::get('/dashboard/orders', [OrderController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.orders');
Route::get('/dashboard/orders/{order}/view', [OrderController::class, 'view'])->middleware(['auth','admin'])->name('dashboard.orders.manage');
Route::post('/dashboard/orders/{order}/ship', [OrderController::class, 'ship'])->middleware(['auth','admin'])->name('dashboard.orders.ship');
Route::post('/dashboard/orders/{order}/cancel', [OrderController::class, 'cancel'])->middleware(['auth','admin'])->name('dashboard.orders.cancel');

require __DIR__.'/auth.php';
