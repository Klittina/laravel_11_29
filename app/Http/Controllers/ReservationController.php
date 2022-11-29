<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    //
    public function index()
    {
        $lendings =  Reservation::all();
        return $lendings;
    }

    public function show($user_id, $book_id, $start)
    {
        $reservation = Reservation::where('user_id', $user_id)->where('book_id', $book_id)->where('start', $start)->get();
        return $reservation[0];
    }
    public function destroy($user_id, $book_id, $start)
    {
        ReservationController::show($user_id, $book_id, $start)->delete();
    }

    public function store(Request $request)
    {
        $reservation = new Reservation();
        $reservation->user_id = $request->user_id;
        $reservation->copy_id = $request->copy_id;
        $reservation->start = $request->start;
        $reservation->save();
    }

    public function update(Request $request, $user_id, $book_id, $start)
    {
        $reservation = ReservationController::show($user_id, $book_id, $start);
        $reservation->user_id = $request->user_id;
        $reservation->copy_id = $request->copy_id;
        $reservation->start = $request->start;
        $reservation->end = $request->end;
        $reservation->extension = $request->extension;
        $reservation->notice = $request->notice;
        $reservation->save();
    }

    public function reservations_per_user()
    {
        $user = Auth::user();
        $reservation = DB::table('reservation as r')
            ->where('r.user_id', '=', $user->id)
            ->count();
        return $reservation;
    }
}
