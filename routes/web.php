<?php

use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\admin\NewsController as AdminNewsController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\VidiosController;


use App\Http\Controllers\Umum\HomeController;
use App\Http\Controllers\Umum\NewsController as UmumNewsController;
use App\Http\Controllers\Umum\DocumentController as UmumDocumentController;
use App\Http\Controllers\Umum\ProfilesController as ProfileUmumController;
use App\Models\News;
use App\Models\Vidios;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//

/* USER */
// Beranda
Route::get('/', [HomeController::class, 'index'])->name('umum.home');
Route::get('/content-pagination', [HomeController::class, 'contentPagination'])->name('content.pagination');

// Dokumen
Route::prefix('dokumen')->group(function () {
    Route::get('/', [UmumDocumentController::class, 'index'])->name('umum.dokumen.index');
    Route::get('/{document_id}/download', [UmumDocumentController::class, 'download'])->name('umum.dokumen.download');
});

// Berita
Route::prefix('berita')->group(function () {
    Route::get('/', [UmumNewsController::class, 'index'])->name('umum.berita.index');
    Route::get('/{news}', [UmumNewsController::class, 'detail'])->name('umum.berita.detail');
});

Route::prefix('profile')->group(function () {
    Route::get('{item}', [ProfileUmumController::class, 'detail'])->name('profile.detail');
});



/* Admin */
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        if(session()->has('isLoggin')){
            return view('admin.dashboard.dashboard');
        }else{
            return view('admin.auth.login');
        }
    })->name('admin.login.page');

    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');


    // Admin News Management
    Route::prefix('news')->group(function () {
        Route::get('/', [AdminNewsController::class, 'index'])->name('admin.news.index');
        Route::get('/create', [AdminNewsController::class, 'directForm'])->name('admin.news.create');
        Route::post('/store', [AdminNewsController::class, 'store'])->name('admin.news.store');
        Route::post('/upload-image', [AdminNewsController::class, 'uploadImage'])->name('admin.news.upload-image');
        Route::post('/detail', [AdminNewsController::class, 'detailNews'])->name('admin.news.detail');
        Route::post('/edit', [AdminNewsController::class, 'edit'])->name('admin.news.edit');
        Route::put('/update/{news_id}', [AdminNewsController::class, 'update'])->name('admin.news.update');
        Route::post('/delete', [AdminNewsController::class, 'delete'])->name('admin.news.delete');
        Route::post('/admin/news/upload-image', [AdminNewsController::class, 'uploadImage'])->name('news.uploadImage');
    });

    // Admin Report Management
    Route::prefix('report')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('admin.report.index');
    });

    // Admin Video Management
    Route::prefix('vidios')->group(function () {
        Route::get('/', [VidiosController::class, 'index'])->name('admin.vidios.index');
        Route::get('/create', [VidiosController::class, 'formCreate'])->name('admin.vidios.create');
        Route::post('/store', [VidiosController::class, 'store'])->name('admin.vidios.store');
        Route::post('/edit', [VidiosController::class, 'edit'])->name('admin.vidios.edit');
        Route::put('/update{vidios_id}', [VidiosController::class, 'update'])->name('admin.vidios.update');
        Route::post('/delete', [VidiosController::class, 'delete'])->name('admin.vidios.delete');
        Route::post('/detail', [VidiosController::class, 'detailVidios'])->name('admin.vidios.detail');
    });


    Route::prefix('document')->group(function () {
        Route::get('/', [AdminDocumentController::class, 'index'])->name('admin.document.index');
        Route::get('/form', [AdminDocumentController::class, 'form'])->name('admin.document.form');
        Route::post('/store', [AdminDocumentController::class, 'store'])->name('admin.document.store');
        Route::post('/edit', [AdminDocumentController::class, 'edit'])->name('admin.document.edit');
        Route::post('/update', [AdminDocumentController::class, 'update'])->name('admin.document.update');
        Route::post('/delete', [AdminDocumentController::class, 'delete'])->name('admin.document.delete');
    });

    Route::prefix('profiles')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('admin.profiles.index');
        Route::get('/create', [ProfileController::class, 'create'])->name('admin.profiles.create');
        Route::post('/store', [ProfileController::class, 'store'])->name('admin.profiles.store');
        Route::post('/edit', [ProfileController::class, 'edit'])->name('admin.profiles.edit');
        Route::put('/update/{profile_id}', [ProfileController::class, 'update'])->name('admin.profiles.update');
        Route::post('/delete', [ProfileController::class, 'delete'])->name('admin.profiles.delete');
        Route::post('/detail', [ProfileController::class, 'detailProfiles'])->name('admin.profiles.detail');
    });
});
