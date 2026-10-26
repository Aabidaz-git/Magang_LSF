<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;

// Root redirect
Route::get('/', function () {
    return redirect()->route('dashboard.home');
});

// Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 1. Home (LSF Data Dashboard)
Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.home');

// 2. Klasifikasi Video (Upload, Real-time Progress, Laporan Adegan)
Route::get('/klasifikasi', [ClassificationController::class, 'index'])->name('klasifikasi.index');
Route::get('/klasifikasi/{id}', [ClassificationController::class, 'show'])->name('klasifikasi.show');
Route::post('/klasifikasi/{id}/verify', [ClassificationController::class, 'verify'])->name('klasifikasi.verify');

// 3. Riwayat Analisis (Audit Log, Search, Filter, Master JSON)
Route::get('/riwayat', [HistoryController::class, 'index'])->name('riwayat.index');
Route::get('/riwayat/{id}/json', [HistoryController::class, 'downloadSingleJson'])->name('riwayat.single-json');
Route::get('/riwayat/export/master-json', [HistoryController::class, 'downloadMasterJson'])->name('riwayat.master-json');
Route::get('/riwayat/export/batch-csv', [HistoryController::class, 'downloadBatchCsv'])->name('riwayat.batch-csv');

// 4. Laporan & Statistik
Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
Route::get('/ringkasan-laporan', [ReportController::class, 'detail'])->name('laporan.detail');

// API Endpoints untuk Chunking Upload & Inference Job Status
Route::prefix('api')->group(function () {
    Route::post('/upload/chunk', [ClassificationController::class, 'chunkUpload'])->name('api.upload.chunk');
    Route::post('/upload/complete', [ClassificationController::class, 'completeUpload'])->name('api.upload.complete');
    Route::get('/job-status', [ClassificationController::class, 'jobStatus'])->name('api.job.status');
    Route::get('/reports/master-json', [HistoryController::class, 'downloadMasterJson'])->name('api.reports.master');
    Route::get('/reports/batch-csv', [HistoryController::class, 'downloadBatchCsv'])->name('api.reports.csv');
});
