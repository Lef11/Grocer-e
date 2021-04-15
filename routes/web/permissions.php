<?php

Route::get('/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
