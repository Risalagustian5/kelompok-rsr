<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Str;
use Illuminate\Support\Facades\Auth; // Tambahan Facade Auth
use App\Models\Villa;

class VillaController extends Controller
{
    // Mengatasi info: Menambahkan type string pada properti
    protected string $supabaseUrl;
    protected string $supabaseKey;

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
        // PERBAIKAN BARIS 31: Menggunakan Auth::id() agar Intelephense tidak error
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/bookings?user_id=eq.' . Auth::id() . '&select=*,villa:villas(*)');
        $bookings = $response->successful() ? $response->json() : [];
        return view('user.villas.history', compact('bookings'));
    }

    // Mengatasi info: Menambahkan tipe data string/int pada $id
    public function userCancelBooking(string $id) {
        $this->client()->patch($this->supabaseUrl . '/rest/v1/bookings?id=eq.' . $id, ['status' => 'cancelled']);
        return back()->with('success', 'Pesanan dibatalkan');
    }

    // --- RUTE ADMIN (Bookings) ---
    public function adminBookings() {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/bookings?select=*,user:users(*),villa:villas(*)');
        $bookings = $response->successful() ? $response->json() : [];
        return view('admin.bookings.index', compact('bookings'));
    }

    public function confirmBooking(string $id) {
        $this->client()->patch($this->supabaseUrl . '/rest/v1/bookings?id=eq.' . $id, ['status' => 'confirmed']);
        return back()->with('success', 'Pesanan dikonfirmasi');
    }

    public function cancelBooking(string $id) {
        $this->client()->patch($this->supabaseUrl . '/rest/v1/bookings?id=eq.' . $id, ['status' => 'cancelled']);
        return back()->with('success', 'Pesanan dibatalkan');
    }

    public function destroyBooking(string $id) {
        $this->client()->delete($this->supabaseUrl . '/rest/v1/bookings?id=eq.' . $id);
        return back()->with('success', 'Pesanan dihapus');
    }

    // --- RUTE VILLA (CRUD) ---
    public function index() {
        $villas = Villa::all();
        return view('user.villas.index', compact('villas')); 
    }

    public function show(string $id) {
        $villa = Villa::find($id);
        return view('user.villas.show', compact('villa')); 
    }

    public function storeBooking(Request $request, string $id) { /* Logika booking */ }
    
    public function adminIndex() {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/villas?select=*');
        $villas = $response->successful() ? $response->json() : [];
        return view('admin.villas.index', compact('villas'));
    }

    public function create() { return view('admin.villas.create'); }

    public function store(Request $request) { /* Logika tambah villa */ }

    public function edit(string $id) {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/villas?id=eq.' . $id);
        $data = $response->json();
        $villa = !empty($data) ? $data[0] : null;
        return view('admin.villas.edit', compact('villa'));
    }

    public function update(Request $request, string $id) { /* Logika update */ }

    public function destroy(string $id) {
        $this->client()->delete($this->supabaseUrl . '/rest/v1/villas?id=eq.' . $id);
        return redirect()->route('admin.villas.index');
    }

    public function book(string $id) {
    // Ganti find() menjadi findOrFail() agar memicu halaman error jika ID tidak ada
    $villa = Villa::findOrFail($id); 

    return view('user.villas.book', ['villa' => $villa]);
    
    }
