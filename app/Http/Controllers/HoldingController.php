<?php

namespace App\Http\Controllers;

use App\Models\Holding;
use Illuminate\Http\Request;

class HoldingController extends Controller
{
    public function index()
    {
        $holdings = Holding::with('category')->latest()->paginate(12);
        return view('holdings.index', compact('holdings'));
    }

    public function show(Holding $holding)
    {
        return view('holdings.show', compact('holding'));
    }
}