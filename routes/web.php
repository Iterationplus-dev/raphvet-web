<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\SitemapController;
use App\Livewire\Admin\Appointments\AppointmentDetail as AdminAppointmentDetail;
use App\Livewire\Admin\Appointments\AppointmentList as AdminAppointmentList;
use App\Livewire\Admin\Content\ContactInbox;
use App\Livewire\Admin\Content\FaqManager;
use App\Livewire\Admin\Content\JobApplications;
use App\Livewire\Admin\Content\TestimonialManager;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Orders\OrderDetail as AdminOrderDetail;
use App\Livewire\Admin\Orders\OrderList as AdminOrderList;
use App\Livewire\Admin\Pets\PetList as AdminPetList;
use App\Livewire\Admin\Products\CategoryList;
use App\Livewire\Admin\Products\ProductForm as AdminProductForm;
use App\Livewire\Admin\Products\ProductList as AdminProductList;
use App\Livewire\Admin\Services\ServiceForm as AdminServiceForm;
use App\Livewire\Admin\Services\ServiceList as AdminServiceList;
use App\Livewire\Admin\Users\UserForm;
use App\Livewire\Admin\Users\UserList;
use App\Livewire\Appointments\AppointmentDetail;
use App\Livewire\Appointments\AppointmentList;
use App\Livewire\Appointments\BookingWizard;
use App\Livewire\Appointments\VetCalendar;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Customer\Dashboard;
use App\Livewire\Customer\OrderHistory;
use App\Livewire\Customer\ProfileSettings;
use App\Livewire\Pets\PetForm;
use App\Livewire\Pets\PetList;
use App\Livewire\Pets\PetProfile;
use App\Livewire\Public\CareersPage;
use App\Livewire\Public\ContactForm;
use App\Livewire\Public\FaqList;
use App\Livewire\Public\HomePage;
use App\Livewire\Public\ServiceDetail;
use App\Livewire\Public\ServicesList;
use App\Livewire\Shop\CartPage;
use App\Livewire\Shop\Checkout;
use App\Livewire\Shop\ProductCatalog;
use App\Livewire\Shop\ProductDetail;
use Illuminate\Support\Facades\Route;

// ── Public routes ─────────────────────────────────────────────────────────────

Route::get('/', HomePage::class)->name('home');
Route::get('/about', fn () => view('pages.about'))->name('about');
Route::get('/services', ServicesList::class)->name('services');
Route::get('/services/{slug}', ServiceDetail::class)->name('services.show');
Route::get('/contact', ContactForm::class)->name('contact');
Route::get('/faq', FaqList::class)->name('faq');
Route::get('/careers', CareersPage::class)->name('careers');
Route::get('/shop', ProductCatalog::class)->name('shop');
Route::get('/shop/{slug}', ProductDetail::class)->name('shop.show');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/book-appointment', BookingWizard::class)->name('appointments.book');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

// ── Guest-only routes ─────────────────────────────────────────────────────────

Route::middleware('guest')->group(function (): void {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
});

// ── Logout ────────────────────────────────────────────────────────────────────

Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');

// ── Customer routes ───────────────────────────────────────────────────────────

Route::middleware('auth')->prefix('my')->name('my.')->group(function (): void {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/profile', ProfileSettings::class)->name('profile');
    Route::get('/orders', OrderHistory::class)->name('orders');
    Route::get('/checkout', Checkout::class)->name('checkout');

    Route::get('/pets', PetList::class)->name('pets');
    Route::get('/pets/create', PetForm::class)->name('pets.create');
    Route::get('/pets/{pet}', PetProfile::class)->name('pets.show');
    Route::get('/pets/{pet}/edit', PetForm::class)->name('pets.edit');

    Route::get('/appointments', AppointmentList::class)->name('appointments');
    Route::get('/appointments/{reference}', AppointmentDetail::class)->name('appointments.show');
});

// ── Vet routes ────────────────────────────────────────────────────────────────

Route::middleware(['auth', 'role:vet|admin'])->prefix('vet')->name('vet.')->group(function (): void {
    Route::get('/calendar', VetCalendar::class)->name('calendar');
});

// ── Admin routes ──────────────────────────────────────────────────────────────

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', AdminDashboard::class)->name('dashboard');

    Route::get('/users', UserList::class)->name('users');
    Route::get('/users/create', UserForm::class)->name('users.create');
    Route::get('/users/{user}/edit', UserForm::class)->name('users.edit');

    Route::get('/services', AdminServiceList::class)->name('services');
    Route::get('/services/create', AdminServiceForm::class)->name('services.create');
    Route::get('/services/{service}/edit', AdminServiceForm::class)->name('services.edit');

    Route::get('/products', AdminProductList::class)->name('products');
    Route::get('/products/create', AdminProductForm::class)->name('products.create');
    Route::get('/products/{product}/edit', AdminProductForm::class)->name('products.edit');
    Route::get('/products/categories', CategoryList::class)->name('products.categories');

    Route::get('/orders', AdminOrderList::class)->name('orders');
    Route::get('/orders/{reference}', AdminOrderDetail::class)->name('orders.show');

    Route::get('/appointments', AdminAppointmentList::class)->name('appointments');
    Route::get('/appointments/{reference}', AdminAppointmentDetail::class)->name('appointments.show');

    Route::get('/pets', AdminPetList::class)->name('pets');

    Route::get('/faqs', FaqManager::class)->name('faqs');
    Route::get('/testimonials', TestimonialManager::class)->name('testimonials');
    Route::get('/contact-inbox', ContactInbox::class)->name('contact-inbox');
    Route::get('/job-applications', JobApplications::class)->name('job-applications');
});
