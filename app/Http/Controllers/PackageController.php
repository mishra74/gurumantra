<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $data['page'] = 'Add Packages';
        $data['packages'] = Package::withTrashed()->latest()->paginate(10);
        return view('admin.packages.index')->with($data);
    }

    public function add()
    {
        $data['page'] = 'All Packages';
        return view('admin.packages.add')->with($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_name' => 'required|string|max:255',
            'package_type' => 'required|in:day,month,year',
            'course_type' => 'required|in:test_notes,recorded_test_notes,live_recorded_test_notes',
            'package_validity' => 'required|integer',
            'mrp' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'expire_at' => 'nullable|date',
            'package_key' => 'required|string|unique:packages',
        ]);

        Package::create($validated);
        return redirect()->route('packages.all')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'package_name' => 'required|string|max:255',
            'package_type' => 'required|in:day,month,year',
            'course_type' => 'required|in:test_notes,recorded_test_notes,live_recorded_test_notes',
            'package_validity' => 'required|integer',
            'mrp' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'expire_at' => 'nullable|date',
            'package_key' => 'required|string|unique:packages,package_key,' . $package->id,
        ]);
        $package->update($validated);
        return redirect()->route('packages.all')->with('success', 'Package updated successfully.');
    }

    public function destroy($id)
    {
       

        $tecaher = Package::withTrashed()->findOrFail($id);
        if ($tecaher->trashed()) {
            return back()->with('success', 'Package deleted');

        }
    
        $tecaher->delete();

        return back()->with('success', 'Package deleted');
    }

    public function restore($id)
    {
        $package = Package::withTrashed()->findOrFail($id);
        $package->restore();
        return back()->with('success', 'Package restored successfully.');
    }

    public function toggleActive($id)
    {
        
        $package = Package::withTrashed()->findOrFail($id);
        $package->is_active = !$package->is_active;
        $package->save();

        return back()->with('success', 'Package status updated.');
    }
}
