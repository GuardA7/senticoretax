<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PreprocessingController;
use App\Http\Controllers\SentimentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EucsController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\ExportController;

// =========================
// DASHBOARD
// =========================
Route::get(
    '/',
    [DashboardController::class, 'index']
)->name('dashboard');

// =========================
// PREPROCESSING
// =========================
Route::get(
    '/preprocessing',
    [PreprocessingController::class, 'index']
)->name('preprocessing');

// =========================
// NAIVE BAYES
// =========================
Route::get(
    '/klasifikasi/nb',
    [SentimentController::class, 'naiveBayes']
)->name('klasifikasi.nb');

// =========================
// SVM
// =========================
Route::get(
    '/klasifikasi/svm',
    [SentimentController::class, 'svm']
)->name('klasifikasi.svm');

// =========================
// INPUT MANUAL
// =========================
Route::post(
    '/manual-input',
    [SentimentController::class, 'manualInput']
)->name('manual.input');

// =========================
// EVALUASI
// =========================
Route::get(
    '/evaluasi',
    [EvaluationController::class, 'index']
)->name('evaluasi');

// =========================
// EUCS
// =========================
Route::get(
    '/eucs',
    [EucsController::class, 'index']
)->name('eucs');

// =========================
// PERBANDINGAN
// =========================
Route::get(
    '/perbandingan',
    [ComparisonController::class, 'index']
)->name('perbandingan');

// =========================
// UPLOAD DATASET
// =========================
Route::post(
    '/upload-dataset',
    [DatasetController::class, 'upload']
)->name('upload.dataset');

// =========================
// CLEAR DATA
// =========================
Route::get(
    '/clear-data',
    [DataController::class, 'clear']
)->name('clear.data');

// =========================
// EXPORT CSV
// =========================
Route::get(
    '/export-laporan',
    [ExportController::class, 'laporan']
)->name('export.laporan');
