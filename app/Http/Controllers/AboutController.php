<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        
        $layout = match($role) {
            'admin' => 'layouts.admin',
            'pimpinan' => 'layouts.pimpinan',
            default => 'layouts.user',
        };

        return view('about.index', compact('layout'));
    }
}
