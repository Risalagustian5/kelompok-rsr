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

    // ✅ Store booking baru
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

        $response = Http::withHeaders($this->headers())
            ->post($this->supabaseUrl.'/rest/v1/bookings', $data);

        return $response->json();
    }

    // ✅ Show detail booking
    public function show($id)
    {
        $response = Http::withHeaders($this->headers())
            ->get($this->supabaseUrl.'/rest/v1/bookings?id=eq.'.$id);

        return $response->json();
    }

    // ✅ Cancel booking
    public function cancel($id)
    {
        $response = Http::withHeaders($this->headers())
            ->patch($this->supabaseUrl.'/rest/v1/bookings?id=eq.'.$id, [
                'status' => 'cancelled'
            ]);

        return $response->json();
    }

    // ✅ Confirm booking
    public function confirm($id)
    {
        $response = Http::withHeaders($this->headers())
            ->patch($this->supabaseUrl.'/rest/v1/bookings?id=eq.'.$id, [
                'status' => 'confirmed'
            ]);

        return $response->json();
    }

    // ✅ Delete booking
    public function destroy($id)
    {
        $response = Http::withHeaders($this->headers())
            ->delete($this->supabaseUrl.'/rest/v1/bookings?id=eq.'.$id);

        return $response->json();
    }

    // ✅ Tambahan: Admin lihat semua bookings
    public function adminBookings()
    {
        $response = Http::withHeaders($this->headers())
            ->get($this->supabaseUrl.'/rest/v1/bookings?select=*,villa(*),users(*)');

        return $response->json();
    }

    // Helper untuk headers Supabase
    private function headers()
    {
        return [
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer '.$this->supabaseKey,
            'Content-Type'  => 'application/json',
        ];
    }
}
