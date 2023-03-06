<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\View\View;

class MerchantsController extends Controller
{
    public function edit(Merchant $merchant): View
    {
        return view('merchants.edit', compact('merchant'));
    }
}
