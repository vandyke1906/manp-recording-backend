<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessTypeController;
use App\Http\Controllers\ApplicationTypeController;
use App\Http\Controllers\ZoningController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicantTypeController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BusinessStatusController;
use App\Http\Controllers\BusinessNatureController;
use App\Http\Controllers\CapitalizationController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\ApplicationFilesController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/send-verification', [AuthController::class, 'sendVerificationEmail']);
Route::post('/verify', [AuthController::class, 'verifyCode']);
Route::post('/request-verification-link', [AuthController::class, 'sendVerificationLink']);
Route::post('/request-password-reset', [AuthController::class, 'sendResetPassword']);
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->middleware(['signed'])->name('verification.verify');//name added for jobs in SendVerificationLink.php
Route::post('/password-reset/{email}/{hash}', [AuthController::class, 'resetPassword'])->middleware(['signed'])->name('password.reset.verify');//name added for jobs in SendVerificationLink.php

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware('throttle:auth-check')->get('/auth/check', [AuthController::class, 'authCheck']);
    Route::post('/auth/refresh', [AuthController::class, 'refreshToken']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', [AuthController::class, 'index']);
    Route::get('/users/profile', [AuthController::class, 'profile']);
    Route::get('/applicant-types/by-ids', [ApplicantTypeController::class, 'getByIds']);

    Route::get('/applications-file/{id}/{name}', [ApplicationController::class, 'getApplicationFile']);
    Route::apiResource('/applications',ApplicationController::class);

    Route::apiResource('/zonings',ZoningController::class);
    Route::apiResource('/application-types',ApplicationTypeController::class);
    Route::apiResource('/business-types',BusinessTypeController::class);
    Route::apiResource('/applicant-types',ApplicantTypeController::class);
    Route::apiResource('/capitalizations',CapitalizationController::class);
    Route::apiResource('/business-natures',BusinessNatureController::class);
    Route::apiResource('/business-statuses',BusinessStatusController::class);  
    Route::apiResource('/approvals',ApprovalController::class); 
    // Route::apiResource('/application-files',ApplicationFilesController::class);
    Route::post('/application-files/{file_id}',[ApplicationFilesController::class, 'update']);
    Route::post('/approvals/{id}/confirm-submission', [ApprovalController::class, 'confirmDocumentsSubmission']);

    Route::get('/download-file/{id}',[ApplicationFilesController::class, 'show'])->name('download-file');

    // Route::get('/download-file', function () {
    //     $businessName = request()->query('business_name');
    //     $filename = request()->query('file_name');
    //     if (!request()->hasValidSignature()) {
    //         return response()->json([
    //             'message' => 'Unauthorized access',
    //         ], 403);
    //     }
    //     // $path = storage_path("app/private/application_files/{$businessName}/{$filename}");
    //     // $path = storage_path('app' . DIRECTORY_SEPARATOR .'private' . DIRECTORY_SEPARATOR .'application_files' . DIRECTORY_SEPARATOR .$businessName . DIRECTORY_SEPARATOR .$filename);
    //     $path = storage_path(implode(DIRECTORY_SEPARATOR, ['app','private','application_files',$businessName,$filename]));

    //     if (!file_exists($path)) {
    //         return response()->json(['message' => 'File not found'], 404); // <-- fixed typo from 'jdson' to 'json'
    //     }

    //     Log::debug($path);
    //     Log::debug(mime_content_type($path));
    //     // Log::debug(mime_content_type(Storage::get($path)));
    //     return response()->file($path, [
    //         'Content-Type' => mime_content_type($path),
    //         'Content-Disposition' => 'inline; filename="' . basename($path) . '"',
    //         // 'Content-Disposition' => 'attachment; filename="' . basename($path) . '"'
    //     ]);
    // })->name('download-file');
});

// Route::get('/download-file', function () {
//         return response()->json([
//         'test' => 'okay',
//     ]);
// });

Route::get('/download-test/{id}',[ApplicationFilesController::class, 'show'])->name('download-test');


//test here
Route::get('/debug-csrf', function () {
    return response()->json([
        'csrf_token' => request()->cookie('XSRF-TOKEN'),
    ]);
});

Route::get('/auth/session-debug', function () {
    return response()->json([
        'session_id' => session()->getId(),
        'session_data' => session()->all(),
    ]);
});


Route::fallback(function () {
    return response()->json([
        'message' => 'Route not found.'
    ], 404);
});