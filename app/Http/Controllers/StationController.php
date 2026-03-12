<?php

namespace App\Http\Controllers;


use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class StationController extends Controller
{

    public function search(Request $request)
    {

        $stations = DB::table('stations')
        ->whereBetween('latitude', [
            $request->latitude - 0.1,
            $request->latitude + 0.1
        ])
        ->whereBetween('longitude', [
            $request->longitude - 0.1,
            $request->longitude + 0.1
        ])
        ->get();

        return response()->json($stations);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Station::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //only admin can add the Station user story o dakeshi
        if($request->user()->role != 'admin'){
            return response()->json(['message'=>'Unauthorized'],403);
        }

        $stations = Station::Create([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'connector_type' => $request->connector_type,
            'status' => $request->status,
            'power' => $request->power,
        ]);

        return [ "Station" => $stations];
    }

    /**
     * Display the specified resource.
     */
    public function show(Station $station)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Station $station)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Station $station)
    {
        //
    }
}
