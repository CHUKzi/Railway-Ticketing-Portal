<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class PackagesController extends Controller
{
    public function index()
    {
        // Index Staff
        $packages = Package::all();
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        // Create packages
        return view('packages.create');
    }

    public function store(Request $request)
    {
        // Store the packages
        $request->validate([
            'name' => 'required|string',
            'credit_points' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        try {
            $package = new Package();
            $package->name = $request->input('name');
            $package->credit_points = $request->input('credit_points');
            $package->price = $request->input('price');
            $package->currency = env('CURRENCY');
            $package->save();
            return redirect()->route('packages.index')->with('SuccessMessage', 'Package created successfully');
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return back()->with('ErrorMessage', 'An error occurred while creating the station.');
        }
    }

    public function edit($id)
    {
        //Edit Package
        $package = Package::find($id);
        return view('packages.edit', compact('package'));

    }

    public function update(Request $request, $id)
    {
        // Update Package
        $request->validate([
            'name' => 'required|string',
            'credit_points' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        try {
            $package = Package::findOrFail($id);
            $package->name = $request->input('name');
            $package->credit_points = $request->input('credit_points');
            $package->price = $request->input('price');
            $package->currency = env('CURRENCY');
            $package->save();
            return redirect()->route('packages.index')->with('SuccessMessage', 'Package updated successfully');
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return back()->with('ErrorMessage', 'An error occurred while updating the package.');
        }
    }

    public function delete()
    {
        // Delete package
    }

    public function destroy($id)
    {
        // Destroy package
        try {
            $package = Package::find($id);
            $package->delete();
            return redirect()->route('packages.index')->with('SuccessMessage', 'Package Delete successfully');
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return back()->with('ErrorMessage', 'An error occurred while updating the package.');
        }
    }
}
