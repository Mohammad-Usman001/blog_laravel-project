<?php

use App\Http\Controllers\BlogpostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     // return view('admin.dashboard');
//     [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.dashboard')};
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Category Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.destroy');

    //Blog Routes
    Route::get('/blogs', [BlogpostController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogpostController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [BlogpostController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/edit/{id}', [BlogpostController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/update/{id}', [BlogpostController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/delete/{id}', [BlogpostController::class, 'delete'])->name('blogs.destroy');

    // Comment Routes
    Route::get('/comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::post('/admin/comments/{id}/approve', [CommentController::class, 'approve'])->name('admin.comments.approve');
    Route::delete('/admin/comments/{id}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
    Route::delete('/admin/comments/bulk-delete', [CommentController::class, 'bulkDelete'])->name('comments.bulkDelete');


    // Like Routes
    Route::get('/likes', [LikeController::class, 'index'])->name('admin.likes');

    // Permission Route
    Route::get('/permission-create',[PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permission-store',[PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permissions',[PermissionController::class, 'index'])->name('permissions.index');
    Route::delete('/permission/{id}',[PermissionController::class, 'destroy'])->name('permission.destroy');
    Route::get('/permission-edit/{id}',[PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('/permission-update/{id}',[PermissionController::class, 'update'])->name('permission.update');

    // Role Route
    Route::get('/roles',[RoleController::class, 'index'])->name('roles.index');
    Route::get('/role-create',[RoleController::class, 'create'])->name('role.create');
    Route::post('/role-store',[RoleController::class, 'store'])->name('role.store');
    Route::get('/role-edit/{id}',[RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role-update/{id}',[RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}',[RoleController::class, 'destroy'])->name('role.destroy');

          // Users Routes
    Route::get('/Users',[UserController::class, 'index'])->name('users.index');
    Route::get('/users-create',[UserController::class, 'create'])->name('users.create');
    Route::delete('/user/{id}',[UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user-edit/{id}',[UserController::class, 'edit'])->name('user.edit');
    Route::put('/user-update/{id}',[UserController::class, 'update'])->name('user.update');
    Route::post('/user-store',[UserController::class, 'store'])->name('user.store');
});

// Frontend Controller
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('blogpost/{slug}', [FrontendController::class, 'show'])->name('frontend.show');
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
Route::post('/like', [LikeController::class, 'store'])->name('like.store');
Route::post('/dislike', [LikeController::class, 'destroy'])->name('like.destroy');

// category controller
Route::get('/category/{id}', [FrontendController::class, 'categoryBlogs'])->name('frontend.category');

require __DIR__ . '/auth.php';
