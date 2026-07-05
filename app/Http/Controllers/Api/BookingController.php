<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking; // Pastikan Model Booking sudah ada

class BookingController extends Controller
{
    // --- Admin ---
    public function adminBookings() {
        // Mengambil semua data booking beserta relasi user dan villa dari MySQL
        $bookings = Booking::with(['user', 'villa'])->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function confirmBooking(string $id) {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'confirmed']);
        return back()->with('success', 'Pesanan dikonfirmasi');
    }

    public function cancelBooking(string $id) {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Pesanan dibatalkan');
    }

    public function destroyBooking(string $id) {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return back()->with('success', 'Pesanan dihapus');
    }

    // --- User ---
    public function historyBooking() {
        // Mengambil history booking user yang sedang login dari MySQL
        $bookings = Booking::where('user_id', Auth::id())->with('villa')->get();
        return view('user.villas.history', compact('bookings'));
    }

    public function userCancelBooking(string $id) {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Booking dibatalkan');
    }
}