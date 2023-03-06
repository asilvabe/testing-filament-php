<?php

use App\Http\Livewire\Merchants\Create;
use App\Http\Livewire\Merchants\Edit;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('merchants/create', Create::class);
Route::get('merchants/{merchant}/edit', Edit::class);
