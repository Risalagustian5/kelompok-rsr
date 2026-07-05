<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VillaController extends Controller
{
    protected $supabaseUrl, $supabaseKey;

    public function __construct() {
        $this->supabaseUrl = rtrim(env('SUPABASE_URL'), '/');
        $this->supabaseKey = env('SUPABASE_KEY');
    }

    private function client() {
        return Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Content-Type' => 'application/json',
            'Prefer' => 'return=representation'
        ]);
    }

    // ==========================
    // VILLA MANAGEMENT (ADMIN)
    // ==========================
    public function adminIndex() {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/villas?select=*');
        $villas = $response->successful() ? $response->json() : [];
        return view('admin.villas.index', compact('villas'));
    }

    public function create() {
        return view('admin.villas.create');
    }

    public function store(Request $request) {
        // ... kode upload villa seperti sebelumnya ...
    }

    public function edit($id) {
        // ... kode edit villa seperti sebelumnya ...
    }

    public function update(Request $request, $id) {
        // ... kode update villa seperti sebelumnya ...
    }

    public function destroy($id) {
        $this->client()->delete($this->supabaseUrl . '/rest/v1/villas?id=eq.' . $id);
        return redirect()->route('admin.villas.index')->with('success', 'Villa berhasil dihapus');
    }

    // ==========================
    // BOOKING MANAGEMENT (ADMIN)
    // ==========================
    public function adminBookings() {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/bookings?select=*');
        $bookings = $response->successful() ? $response->json() : [];
        return view('admin.bookings.index', compact('bookings'));
    }

    public function confirmBooking($id) {
        $this->client()->patch($this->supabaseUrl . '/rest/v1/bookings?id=eq.' . $id, [
            'status' => 'confirmed'
        ]);
        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dikonfirmasi');
    }

    public function cancelBooking($id) {
        $this->client()->patch($this->supabaseUrl . '/rest/v1/bookings?id=eq.' . $id, [
            'status' => 'cancelled'
        ]);
        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dibatalkan');
    }

    public function destroyBooking($id) {
        $this->client()->delete($this->supabaseUrl . '/rest/v1/bookings?id=eq.' . $id);
        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dihapus');
    }
}
