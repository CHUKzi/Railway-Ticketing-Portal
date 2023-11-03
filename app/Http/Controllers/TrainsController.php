<?php

namespace App\Http\Controllers;

use App\Models\Train;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrainsController extends Controller
{
    public function index()
    {
        // Index Trains
        $trains = Train::orderBy('created_at')->get();
        return view('trains.index', compact('trains'));
    }

    public function create()
    {
        // Create Trains
        return view('trains.create');
    }

    public function store(Request $request)
    {
        // Store Trains
        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'class_1' => 'boolean',
            'class_2' => 'boolean',
            'class_3' => 'boolean',
            'year' => 'nullable|integer',
            'weight' => 'nullable|numeric',
            'locomotives' => 'required|string',
            'reporting_number' => 'required|string',
        ]);

        try {
            $train = new Train();
            $train->name = $request->input('name');
            $train->class_1 = $request->has('class_1');
            $train->class_2 = $request->has('class_2');
            $train->class_3 = $request->has('class_3');
            $train->year = $request->input('year');
            $train->weight = $request->input('weight');
            $train->locomotives = $request->input('locomotives');
            $train->reporting_number = $request->input('reporting_number');

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('build/trains/images/'), $imageName);
                $train->image = $imageName;
            }

            $train->save();

            return redirect()->route('trains.index')
                ->with('SuccessMessage', 'Train added successfully');
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return back()->with('ErrorMessage', 'An error occurred while updating the package.');
        }
    }

    public function edit($id)
    {
        // Edit Trains
        $train = Train::find($id);
        return view('trains.edit',compact('train'));
    }

    public function update(Request $request, $id)
    {
        // Update Trains
        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'class_1' => 'boolean',
            'class_2' => 'boolean',
            'class_3' => 'boolean',
            'year' => 'nullable|integer',
            'weight' => 'nullable|numeric',
            'locomotives' => 'required|string',
            'reporting_number' => 'required|string',
        ]);

        try {
            $train = Train::find($id);
            $train->name = $request->input('name');
            $train->class_1 = $request->has('class_1');
            $train->class_2 = $request->has('class_2');
            $train->class_3 = $request->has('class_3');
            $train->year = $request->input('year');
            $train->weight = $request->input('weight');
            $train->locomotives = $request->input('locomotives');
            $train->reporting_number = $request->input('reporting_number');

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('build/trains/images/'), $imageName);
                $train->image = $imageName;
            }

            $train->save();

            return redirect()->route('trains.index')
                ->with('SuccessMessage', 'Train updated successfully');
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return back()->with('ErrorMessage', 'An error occurred while updating the train.');
        }
    }

    public function delete()
    {
        // Delete Trans
    }

    public function destroy($id)
    {
        // Destroy Trains
        $train = Train::find($id);
        $train->delete();
        return redirect()->route('trains.index')->with('SuccessMessage', 'Train deleted successfully');
    }
}
