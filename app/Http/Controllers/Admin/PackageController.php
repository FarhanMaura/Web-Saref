<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'features' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $featuresArray = array_map('trim', explode("\n", $request->features));
        $featuresArray = array_filter($featuresArray); // Remove empty lines

        $packageData = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'features' => $featuresArray,
            'is_active' => $request->has('is_active')
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('packages', 'public');
            $packageData['image'] = $imagePath;
        }

        Package::create($packageData);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'features' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $featuresArray = array_map('trim', explode("\n", $request->features));
        $featuresArray = array_filter($featuresArray);

        $package->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'features' => $featuresArray,
            'is_active' => $request->has('is_active')
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('packages', 'public');
            $package->update(['image' => $imagePath]);
        }

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diupdate!');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dihapus!');
    }
}
