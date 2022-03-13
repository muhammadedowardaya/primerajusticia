<?php

use App\Http\Controllers\{AdminBantuanHukumController, AdminCategoryController, AdminGalleryController, AdminGambarController, AdminPengacaraController, AdminProfileController, CategoryController, ContactController, DashboardPostController, GalleryController, PrimeraJusticiaController, PostController};
use App\Http\Controllers\{LoginController, RegisterController};

use App\Models\{Category, User, Post};
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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


// Himatika Profile
Route::get('/', [PrimeraJusticiaController::class, 'index'])->name('himatika.index');

// Route::get('/about', function () {
//     return view('himatika.about');
// })->name('himatika.about');

// Route::get('/organization', function () {
//     return view('himatika.organization');
// })->name('himatika.organization');

// Route::get('/post/{category:name}', function (Category $category) {
//     $data = [
//         'events' => $category->posts()->latest()->paginate(6)
//     ];
//     return view('himatika.event', $data);
// });


// Login--------------------------------
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Register------------------------------
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store'])->middleware('auth')->name('register');

// Contact
Route::post('/contact', [ContactController::class, 'sendMail'])->name('contact');


// Dashboard-----------------------------
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

// cek slug untuk membuat post baru
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');

// Dashboard Post-------------------------
Route::prefix('/dashboard/posts')->middleware('auth')->group(function () {
    Route::get('/', [DashboardPostController::class, 'index']);
    Route::get('/create', [DashboardPostController::class, 'create'])->name('posts.create');
    Route::get('/{post:slug}', [DashboardPostController::class, 'show']);
    Route::get('/edit/{post:slug}', [DashboardPostController::class, 'edit'])->name('posts.edit');
    Route::post('/', [DashboardPostController::class, 'store'])->name('posts.store');
    Route::delete('/{post}', [DashboardPostController::class, 'destroy']);
    Route::patch('/{post:slug}', [DashboardPostController::class, 'update'])->name('posts.update');
});


// Posts------------------------------------
Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts');
    Route::get('show/{post:slug}', [PostController::class, 'show'])->name('posts.show');
});

// Category-----------------------------------
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories');
    Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
});

// Admin Category
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('auth');
Route::post('/dashboard/categories/getUbah', [AdminCategoryController::class, 'getUbah'])->name('categories.getUbah')->middleware('auth');

// Admin Pengacara
Route::resource('/dashboard/pengacara', AdminPengacaraController::class)->except('show')->middleware('auth');
Route::post('/dashboard/pengacara/getUbah', [AdminPengacaraController::class, 'getUbah'])->name('pengacara.getUbah')->middleware('auth');

// Admin Gallery
Route::resource('/dashboard/galleries', AdminGalleryController::class)->except('show')->middleware('auth');
Route::post('/dashboard/galleries/getUbah', [AdminGalleryController::class, 'getUbah'])->name('galleries.getUbah')->middleware('auth');

// Admin Gambar
Route::resource('/dashboard/gambar', AdminGambarController::class)->except(['show', 'delete', 'store'])->middleware('auth');
Route::post('/dashboard/gambar/getUbah', [AdminGambarController::class, 'getUbah'])->name('gambar.getUbah')->middleware('auth');

// Admin Bantuan Hukum
Route::resource('/dashboard/bantuan', AdminBantuanHukumController::class)->except('show')->middleware('auth');
Route::post('/dashboard/bantuan/getUbah', [AdminBantuanHukumController::class, 'getUbah'])->name('bantuan.getUbah')->middleware('auth');

// Admin Profile
Route::resource('/dashboard/profile', AdminProfileController::class)->except('show')->middleware('auth');
Route::post('/dashboard/profile/getUbah', [AdminProfileController::class, 'getUbah'])->name('profile.getUbah')->middleware('auth');

// Author
Route::get('authors/{author:username}', function (User $author) {
    return view('posts.index', [
        'title' => "Post By Author : $author->name",
        'posts' => $author->posts->load('category', 'author')
    ]);
});