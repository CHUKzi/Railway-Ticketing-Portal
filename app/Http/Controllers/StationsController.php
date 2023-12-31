<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Station;
use App\Models\TicketChecker;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StationsController extends Controller
{
    public function index()
    {
        // Index Train Stations
        $stations = Station::select('stations.*', 'districts.name as district_name')
            ->join('districts', 'stations.district_id', '=', 'districts.id')
            ->orderBy('stations.name')
            ->get();

        return view('stations.index', compact('stations'));
    }

    public function create()
    {
        // Create Station
        $districts = District::orderBy('name')->get();
        return view('stations.create', compact('districts'));
    }

    public function view($id)
    {
        $station = Station::select('stations.*', 'districts.name as district_name')
            ->join('districts', 'stations.district_id', '=', 'districts.id')
            ->where('stations.id', $id)
            ->first();

        $ticket_checkers = TicketChecker::where('station_id', $id)->get();

        return view('stations.view', compact('station', 'ticket_checkers'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'district' => 'required|exists:districts,id',
            'longitude' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            $station = new Station();
            $station->name = $request->input('name');
            $station->phone = $request->input('phone');
            $station->district_id = $request->input('district');
            $station->longitude = $request->input('longitude');
            $station->latitude = $request->input('latitude');
            $station->description = $request->input('description');

            $station->save();

            //File name
            $uniqueId = time() . '-' . uniqid();
            $qr_file_name = 's-' . $station->id . '-d-' . $station->district_id . 'u-' . $uniqueId . '.svg';
            $qrCodeSvg = QrCode::size(200)->generate($station->id);

            File::put(public_path('build/stations/qr_codes/' . $qr_file_name), $qrCodeSvg);

            $station->qr_code = $qr_file_name;

            $station->save();

            return redirect()->route('stations.index')->with('SuccessMessage', 'Station created successfully');
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return back()->with('ErrorMessage', 'An error occurred while creating the station.');
        }
    }

    public function edit($id)
    {
        //Edit Station

        $station = Station::find($id);
        $districts = District::orderBy('name')->get();
        return view('stations.edit', compact('station', 'districts'));
    }
    public function update(Request $request, $id)
    {
        //Update Station

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'district' => 'required|exists:districts,id',
            'longitude' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {

            $station = Station::find($id);

            $station->name = $request->input('name');
            $station->phone = $request->input('phone');
            $station->district_id = $request->input('district');
            $station->longitude = $request->input('longitude');
            $station->latitude = $request->input('latitude');
            $station->description = $request->input('description');
            $station->save();

            return redirect()->route('stations.index')->with('SuccessMessage', 'Station updated successfully');
        } catch (Exception $e) {

            return back()->with('ErrorMessage', 'An error occurred while updating the station.');
        }
    }


    public function delete()
    {
    }

    public function destroy($id)
    {
        $station = Station::find($id);
        $station->delete();
        return redirect()->route('stations.index')->with('SuccessMessage', 'Station deleted successfully');
    }

    /*
    *
    *Ticket Checkers
    *
    *
    */

    public function checker_create($id)
    {
        $station = Station::find($id);
        return view('stations.create_checker', compact('station'));
    }

    public function checker_store(Request $request)
    {
        // Store the station ticket checker
        $request->validate([
            'station_id' => 'required|exists:stations,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|unique:ticket_checkers,email',
            'password' => 'required|string',
            'address' => 'required|string',
        ]);

        try {
            // Create a new TicketChecker instance
            $ticketChecker = new TicketChecker();
            $ticketChecker->station_id = $request->input('station_id');
            $ticketChecker->name = $request->input('name');
            $ticketChecker->phone = $request->input('phone');
            $ticketChecker->email = $request->input('email');
            $ticketChecker->password = Hash::make($request->input('password'));
            $ticketChecker->address = $request->input('address');

            $ticketChecker->save();

            return redirect()->route('stations.index')->with('SuccessMessage', 'Ticket Checker created successfully');
        } catch (Exception $e) {

            return back()->with('ErrorMessage', 'An error occurred while creating the Ticket Checker.');
        }
    }

    public function checker_history($station_id, $id)
    {
        //  Checker history
        $station = Station::find($station_id);
        $checker = TicketChecker::find($id);

        return view('stations.view_checker_history', compact('station','checker'));
    }

    public function delete_checker($id)
    {
        $checker = TicketChecker::find($id);
        $checker->delete();
        return redirect()->route('stations.index')->with('SuccessMessage', 'Ticket Checker delete successfully');
    }
}
