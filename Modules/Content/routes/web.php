<?php

use Illuminate\Support\Facades\Route;
use Modules\Content\Http\Controllers\ContentController;

Route::as('content.')->prefix('content')->group(function () {
    Route::prefix('admin')->middleware(['role:super-admin'])->group(function () {
        Route::get('create' , \Modules\Content\Livewire\ContentCreate::class)->name('create');
        Route::get('update\{Content}' , \Modules\Content\Livewire\ContentUpdate::class)->name('update');
    });
    Route::get('/index', \Modules\Content\Livewire\ContentIndex::class)->name('index');
    Route::get('/visited-content', \Modules\Content\Livewire\VisitedContent::class)->name('visited');


});
