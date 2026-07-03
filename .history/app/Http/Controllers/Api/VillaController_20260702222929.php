<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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

    // ==========================
    // VILLA MANAGEMENT (ADMIN)
    // ==========================
    public function adminIndex() {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/villas?select=*');
        $villas   = $response->successful() ? $response->json() : [];
        return view('admin.villas.index', compact('villas'));
    }

    public function create() {
        return view('admin.villas.create');
    }

    public function store(Request $request) {
        $file     = $request->file('foto');
        $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) 
                  . '.' . $file->getClientOriginalExtension();

        // Upload foto ke Supabase Storage
        $upload = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Content-Type'  => $file->getMimeType()
        ])->withBody(file_get_contents($file->getRealPath()), $file->getMimeType())
          ->post($this->supabaseUrl . '/storage/v1/object/villas/' . $fileName);

        if ($upload->successful()) {
            // Simpan data villa ke Supabase
            $this->client()->post($this->supabaseUrl . '/rest/v1/villas', [
                'nama_villa' => $request->nama_villa,
                'lokasi'     => $request->lokasi,
                'harga'      => $request->harga,
                'deskripsi'  => $request->deskripsi,
                'foto'       => $this->supabaseUrl . '/storage/v1/object/public/villas/' . $fileName
            ]);
            return redirect()->route('admin.villas.index')->with('success', 'Villa berhasil ditambah');
        }
        return back()->withErrors(['foto' => 'Upload Gagal']);
    }

    public function edit($id) {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/villas?id=eq.' . $id);
        $data     = $response->json();
        $villa    = (!empty($data)) ? (object) $data[0] : null;
        return view('admin.villas.edit', compact('villa'));
    }

    public function update(Request $request, $id) {
        $data = $request->only(['nama_villa', 'lokasi', 'harga', 'deskripsi']);

        if ($request->hasFile('foto')) {
            $file     = $request->file('foto');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) 
                      . '.' . $file->getClientOriginalExtension();

            Http::withHeaders([
                'apikey'        => $this->supabaseKey,
                'Authorization' => 'Bearer ' . $this->supabaseKey,
                'Content-Type'  => $file->getMimeType()
            ])->withBody(file_get_contents($file->getRealPath()), $file->getMimeType())
              ->post($this->supabaseUrl . '/storage/v1/object/villas/' . $fileName);

            $data['foto'] = $this->supabaseUrl . '/storage/v1/object/public/villas/' . $fileName;
        }

        $this->client()->patch($this->supabaseUrl . '/rest/v1/villas?id=eq.' . $id, $data);
        return redirect()->route('admin.villas.index')->with('success', 'Villa berhasil diupdate');
    }

    public function destroy($id) {
        $this->client()->delete($this->supabaseUrl . '/rest/v1/villas?id=eq.' . $id);
        return redirect()->route('admin.villas.index')->with('success', 'Villa berhasil dihapus');
    }

    // ==========================
    // VILLA MANAGEMENT (USER)
    // ==========================
    public function index() {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/villas?select=*');
        $data     = $response->successful() ? $response->json() : [];
        $villas   = array_map(fn($v) => (object) $v, $data);
        return view('user.villas.index', compact('villas'));
    }

    public function show($id) {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/villas?id=eq.' . $id);
        $data     = $response->json();
        $villa    = (!empty($data)) ? (object) $data[0] : null;
        return view('user.villas.show', compact('villa'));
    }

    // ==========================
    // BOOKING MANAGEMENT (USER)
    // ==========================
    public function storeBooking(Request $request, $id) {
        $request->validate([
            'check_in'    => 'required|date',
            'check_out'   => 'required|date|after:check_in',
            'jumlah_tamu' => 'required|integer|min:1',
        ]);

        $response = $this->client()->post($this->supabaseUrl . '/rest/v1/bookings', [
            'villa_id'    => $id,
            'user_id'     => auth()->id(),
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'jumlah_tamu' => $request->jumlah_tamu,
            'status'      => 'pending'
        ]);

        if ($response->successful()) {
            return redirect()->route('villas.show', $id)->with('success', 'Booking berhasil dibuat, menunggu konfirmasi admin.');
        }

        return back()->withErrors(['msg' => 'Gagal membuat booking.']);
    }

    public function historyBooking() {
        $response = $this->client()->get(
            $this->supabaseUrl . '/rest/v1/bookings?select=*,villa:villas(id,nama_villa,lokasi,harga,foto,deskripsi)&user_id=eq.' . auth()->id()
        );

        $data = $response->successful() ? $response->json() : [];

        $bookings = array_map(function($b) {
            $b = (object) $b;
            if (isset($b->villa)) {
                $b->villa = (object) $b->villa;
            }
            return $b;
        }, $data);

        return view('user.villas.history', compact('bookings'));
    }

    public function userCancelBooking($id) {
        $this->client()->patch($this->supabaseUrl . '/rest/v1/bookings?id=eq.' . $id, [
            'status' => 'cancelled'
        ]);
        return redirect()->route('history')->with('success', 'Booking berhasil dibatalkan.');
    }

    // ==========================
    // BOOKING MANAGEMENT (ADMIN)
    // ==========================
    public function adminBookings() {
        $response = $this->client()->get(
            $this->supabaseUrl . '/rest/v1/bookings?select=*,villa:villas(id,nama_villa,lokasi,harga,foto,deskripsi)'
        );

        $data = $response->successful() ? $response->json() : [];

        $bookings = array_map(function($b) {
            $b = (object) $b;
            if (isset($b->villa)) {
                $b->villa = (object) $b->villa;
            }
            return $b;
        }, $data);

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
}