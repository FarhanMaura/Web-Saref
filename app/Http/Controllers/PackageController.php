<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)->get();
        return view('packages.index', compact('packages'));
    }

    public function show(Package $package)
    {
        // Untuk admin, tampilkan semua reviews
        // Untuk user biasa, hanya tampilkan yang visible
        if (auth()->check() && auth()->user()->isAdmin()) {
            $reviews = $package->reviews()->with('user')->get();
        } else {
            $reviews = $package->reviews()->where('is_visible', true)->with('user')->get();
        }

        return view('packages.show', compact('package', 'reviews'));
    }
}
