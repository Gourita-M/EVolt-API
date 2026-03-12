<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class SessionController extends Controller
{
    public function history(Request $request)
    {
        
        $sessions = Reservation::where('users_id',$request->user()->id)
        ->get();

        return response()->json($sessions);

    }
}
