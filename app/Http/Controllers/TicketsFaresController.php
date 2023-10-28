<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\TicketsFare;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TicketsFaresController extends Controller
{
    public function index()
    {
        // Tickets Fares
        $tickets_fares = TicketsFare::select([
            'tickets_fares.id as fares_id',
            'stations_from.name as from_station',
            'stations_to.name as to_station',
            'tickets_fares.class_1_price',
            'tickets_fares.class_2_price',
            'tickets_fares.class_3_price',
            'tickets_fares.created_at as added_date',
        ])
            ->join('stations as stations_from', 'stations_from.id', '=', 'tickets_fares.from_station_id')
            ->join('stations as stations_to', 'stations_to.id', '=', 'tickets_fares.to_station_id')
            ->get();

        return view('tickets-fares.index', compact('tickets_fares'));
    }

    public function create()
    {
        // Create tickets
        $stations = Station::orderBy('name')->get();
        return view('tickets-fares.create', compact('stations'));
    }

    public function store(Request $request)
    {
        // Store tickets

        $customValidationRules = [
            'from_station_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value === $request->input('to_station_id')) {
                        $fail($attribute . ' must be different from To Station.');
                    }
                },
            ],
            'to_station_id' => 'required|integer',
            '1_class_price' => 'required|numeric',
            '2_class_price' => 'required|numeric',
            '3_class_price' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $customValidationRules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $existingRecord = TicketsFare::where('from_station_id', $request->input('from_station_id'))
            ->where('to_station_id', $request->input('to_station_id'))
            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('ErrorMessage', 'Already created the ticket fare for the route');
        }

        $existingRecord = TicketsFare::where('to_station_id', $request->input('from_station_id'))
            ->where('from_station_id',  $request->input('to_station_id'))
            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('ErrorMessage', 'Already created the ticket fare for the route');
        }

        try {

            $ticketsFare = new TicketsFare();
            $ticketsFare->from_station_id = $request->input('from_station_id');
            $ticketsFare->to_station_id = $request->input('to_station_id');
            $ticketsFare->class_1_price = $request->input('1_class_price');
            $ticketsFare->class_2_price = $request->input('2_class_price');
            $ticketsFare->class_3_price = $request->input('3_class_price');
            $ticketsFare->currency = env('CURRENCY');
            $ticketsFare->save();

            $ticketsFare2 = new TicketsFare();
            $ticketsFare2->from_station_id = $request->input('to_station_id');
            $ticketsFare2->to_station_id = $request->input('from_station_id');
            $ticketsFare2->class_1_price = $request->input('1_class_price');
            $ticketsFare2->class_2_price = $request->input('2_class_price');
            $ticketsFare2->class_3_price = $request->input('3_class_price');
            $ticketsFare2->currency = env('CURRENCY');
            $ticketsFare2->save();

            return redirect()->route('tickets.fares.index')->with('SuccessMessage', 'Tickets Fare created successfully');
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return redirect()->back()->with('ErrorMessage', 'An error occurred while creating the ticket fare.');
        }
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

    public function destroy($id)
    {
        // Destroy tickets
        try {
            $tickets = TicketsFare::find($id);
            $tickets1 = TicketsFare::where('to_station_id', $tickets->to_station_id)
                ->where('from_station_id', $tickets->from_station_id)
                ->first();

            $tickets2 = TicketsFare::where('to_station_id', $tickets->from_station_id)
                ->where('from_station_id',  $tickets->to_station_id)
                ->first();
            $tickets1->delete();
            $tickets2->delete();
            return redirect()->back()->with('SuccessMessage', 'Delete Ticket Successfully');
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return redirect()->back()->with('ErrorMessage', 'An error occurred while delete the ticket fare.');
        }
    }
}
