<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatsRequest;
use App\Http\Requests\UpdateStatsRequest;
use App\Models\Stats;
use Symfony\Component\HttpFoundation\Request;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = Stats::get();

        return response()->json($stats);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Stats $stats)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatsRequest $request, Stats $stats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stats $stats)
    {
        //
    }
}
