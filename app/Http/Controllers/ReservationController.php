<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Reservation::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'users_id' => 'Required|max:255',
            'stations_id' => 'Required|max:255',
            'start_time' => 'Required|max:255',
            'duration' => 'Required|max:255',
            'status' => 'Required|max:255',
            'energy_delivered' => 'Required|max:255',
        ]);

        $reservations = Reservation::Create($data);

        return [ 'reservation' => $reservations ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return [ 'reservation' => $reservation ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
