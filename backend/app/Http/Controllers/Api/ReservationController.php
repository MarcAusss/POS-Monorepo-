<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Users submit reservation (public)
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'contact_number'=>'required|string',
            'address'=>'required|string',
            'fruit_id'=>'required|exists:fruits,id',
            'quantity'=>'required|integer|min:1',
            'pickup_time'=>'required|date',
            'selfie_image'=>'nullable|image|max:2048'
        ]);

        $path = $request->file('selfie_image')?->store('selfies','public');

        $reservation = Reservation::create([
            'name'=>$request->name,
            'contact_number'=>$request->contact_number,
            'address'=>$request->address,
            'fruit_id'=>$request->fruit_id,
            'quantity'=>$request->quantity,
            'pickup_time'=>$request->pickup_time,
            'selfie_image'=>$path,
            'status'=>'pending'
        ]);

        return response()->json([
            'message'=>'Reservation submitted successfully',
            'reservation_id'=>$reservation->id
        ]);
    }

    // Admin views all reservations
    public function index()
    {
        return Reservation::with('fruit')->get();
    }

    // Admin or reference view
    public function show(Reservation $reservation)
    {
        return $reservation->load('fruit');
    }

    // Admin updates status (approve, complete)
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status'=>'required|in:pending,approved,completed'
        ]);

        $reservation->update(['status'=>$request->status]);
        return response()->json($reservation);
    }

    // Admin deletes reservation
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(['message'=>'Deleted']);
    }
}