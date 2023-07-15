<?php

use App\Http\Controllers\Api\v1\Info\DeveloperNoteController;
use App\Http\Controllers\Api\v1\Info\FAQController;
use Illuminate\Support\Facades\Route;

Route::middleware(['multilang', 'force.json', 'auth:api'])->prefix('info')->group(function () {
  // FAQ
  Route::apiResource('faq', FAQController::class);
  Route::post('faq-restore/{id}', [FAQController::class, 'restore']);
  Route::delete('faq-delete/{id}', [FAQController::class, 'delete']);
  // end FAQ

  // developerNote
  Route::apiResource('developerNote', DeveloperNoteController::class);
  Route::post('developerNote-restore/{id}', [DeveloperNoteController::class, 'restore']);
  Route::delete('developerNote-delete/{id}', [DeveloperNoteController::class, 'delete']);
  // end FAQ
});
