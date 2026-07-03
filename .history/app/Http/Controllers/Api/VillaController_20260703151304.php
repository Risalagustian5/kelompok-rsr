<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Villa;

class VillaController extends Controller
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

    // --- RUTE USER (History & Cancel) ---
    public function historyBooking() {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/bookings?user_id=eq.' . auth()->id() . '&select=*,villa:villas(*)');
        $bookings = $response->successful() ? $response->json() : [];
        return view('user.villas.history', compact('bookings'));
    }

    public function userCancelBooking($id) {
        $this->client()->patch($this->supabaseUrl . '/rest/v1/bookings?id=eq.' . $id, ['status' => 'cancelled']);
        return back()->with('success', 'Pesanan dibatalkan');
    }

    // --- RUTE ADMIN (Bookings) ---
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

    // --- RUTE VILLA (CRUD) ---
    public function index() {
    // Pastikan variabel $villas (atau apapun) tidak null atau error saat mengambil data
    $villas = Villa::all(); // atau hasil call API Anda
    return view('user.villas.index', compact('villas')); 
    }
    public function show($id) {
    // Cari villa berdasarkan ID
    $villa = Villa::find($id);
    
    // Debugging: cek apakah data ada
    dd($villa); 

    return view('user.villas.show', compact('villa')); 
    }
    public function storeBooking(Request $request, $id) { /* Logika booking */ }
    
    public function adminIndex() {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/villas?select=*');
        $villas = $response->successful() ? $response->json() : [];
        return view('admin.villas.index', compact('villas'));
    }

    public function create() { return view('admin.villas.create'); }

    public function store(Request $request) { /* Logika tambah villa */ }

    public function edit($id) {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/villas?id=eq.' . $id);
        $data = $response->json();
        $villa = !empty($data) ? $data[0] : null;
        return view('admin.villas.edit', compact('villa'));
    }

    public function update(Request $request, $id) { /* Logika update */ }

    public function destroy($id) {
        $this->client()->delete($this->supabaseUrl . '/rest/v1/villas?id=eq.' . $id);
        return redirect()->route('admin.villas.index');
    }
}