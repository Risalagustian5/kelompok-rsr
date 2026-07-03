<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    protected $supabaseUrl;
    protected $supabaseKey;

    public function __construct()
    {
        $this->supabaseUrl = env('SUPABASE_URL');
        $this->supabaseKey = env('SUPABASE_KEY');
    }

    public function store(Request $request, $villaId)
    {
        $data = [
            'user_id'     => Auth::id(),
            'villa_id'    => $villaId,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'jumlah_tamu' => $request->jumlah_tamu,
            'status'      => 'pending',
        ];

        $response = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer '.$this->supabaseKey,
            'Content-Type' => 'application/json',
        ])->post($this->supabaseUrl.'/rest/v1/bookings', $data);

        return $response->json();
    }

    public function show($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer '.$this->supabaseKey,
        ])->get($this->supabaseUrl.'/rest/v1/bookings?id=eq.'.$id);

        return $response->json();
    }

    public function cancel($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer '.$this->supabaseKey,
            'Content-Type' => 'application/json',
        ])->patch($this->supabaseUrl.'/rest/v1/bookings?id=eq.'.$id, [
            'status' => 'cancelled'
        ]);

        return $response->json();
    }

    public function confirm($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer '.$this->supabaseKey,
            'Content-Type' => 'application/json',
        ])->patch($this->supabaseUrl.'/rest/v1/bookings?id=eq.'.$id, [
            'status' => 'confirmed'
        ]);

        return $response->json();
    }

    public function destroy($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer '.$this->supabaseKey,
        ])->delete($this->supabaseUrl.'/rest/v1/bookings?id=eq.'.$id);

        return $response->json();
    }
}