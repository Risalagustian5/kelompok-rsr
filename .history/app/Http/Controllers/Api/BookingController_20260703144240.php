<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{
    protected $supabaseUrl, $supabaseKey;

    public function __construct() {
        $this->supabaseUrl = rtrim(env('SUPABASE_URL'), '/');
        $this->supabaseKey = env('SUPABASE_KEY');
    }

    private function client() {
        return Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Content-Type'  => 'application/json',
            'Prefer'        => 'return=representation'
        ]);
    }

    // --- Admin ---
    public function adminBookings() {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/bookings?select=*,user:users(*),villa:villas(*)');
        $bookings = $response->successful() ? $response->json() : [];
        return view('admin.bookings.index', compact('bookings'));
    }

    public function confirmBooking($id) {
        $this->client()->patch($this->supabaseUrl . '/rest/v1/bookings?id=eq.' . $id, ['status' => 'confirmed']);
        return back()->with('success', 'Pesanan dikonfirmasi');
    }

    public function cancelBooking($id) {
        $this->client()->patch($this->supabaseUrl . '/rest/v1/bookings?id=eq.' . $id, ['status' => 'cancelled']);
        return back()->with('success', 'Pesanan dibatalkan');
    }

    public function destroyBooking($id) {
        $this->client()->delete($this->supabaseUrl . '/rest/v1/bookings?id=eq.' . $id);
        return back()->with('success', 'Pesanan dihapus');
    }

    // --- User ---
    public function historyBooking() {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/bookings?user_id=eq.' . auth()->id() . '&select=*,villa:villas(*)');
        $bookings = $response->successful() ? $response->json() : [];
        return view('user.villas.history', compact('bookings'));
    }

    public function userCancelBooking($id) {
        $this->client()->patch($this->supabaseUrl . '/rest/v1/bookings?id=eq.' . $id, ['status' => 'cancelled']);
        return back()->with('success', 'Booking dibatalkan');
    }
}