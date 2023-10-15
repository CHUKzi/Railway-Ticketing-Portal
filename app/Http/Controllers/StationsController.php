<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class StationsController extends Controller
{
    public function index()
    {
        // Index Train Stations
        return view('stations.index');
    }

    public function create()
    {
        // Create Station
        $districts = District::orderBy('name')->get();
        return view('stations.create', compact('districts'));
    }

    public function store()
    {

    }

    public function edit()
    {

    }
    public function update()
    {

    }

    public function delete()
    {

    }

    public function destroy()
    {

    }
}
