<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function cancel(Request $request, $id)
    {
        
        $exist = Reservation::where('id',$id)
        ->where('users_id', auth()->user()->id)
        ->update([
            'status'=>'cancelled'
        ]);

        if(!$exist){
            return response()->json([
            'message'=>'Reservation Not Found'
        ]);
        }
        return response()->json([
            'message'=>'Reservation cancelled'
        ]);

    }
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
            'stations_id' => 'Required|max:255',
            'start_time' => 'Required|max:255',
            'duration' => 'Required|max:255',
            'status' => 'Required|max:255',
            'energy_delivered' => 'Required|max:255',
        ]);

        $reservations = Reservation::Create([
            'users_id' => $request->user()->id,
            'stations_id' => $data['stations_id'],
            'start_time' => $data['start_time'],
            'duration' => $data['duration'],
            'status' => $data['status'],
            'energy_delivered' => $data['energy_delivered'],
        ]);

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
    public function update(Request $request, $id)
    {
        Reservation::Where("id", $id)
                    ->update([
                        'start_time'=>$request['start_time'],
                        'duration'=>$request['duration']
                    ]);

        return response()->json([
            'message'=>'Reservation updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
