<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAddressController extends Controller
{
    /**
     * Menyimpan Alamat Baru
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        // Perhatikan field 'province' dan 'city' wajib ada (dikirim via hidden input)
        $validated = $request->validate([
            'address_type' => 'required|string|max:50',
            'address_line' => 'required|string',
            'city_id'      => 'required|numeric', // ID dari API
            'city'         => 'required|string',  // Nama Kota
            'province'     => 'required|string',  // Nama Provinsi
            'postal_code'  => 'required|string',  // Kode Pos
            'is_primary'   => 'nullable|boolean',
        ]);

        DB::beginTransaction();
        try {
            $user = Auth::user();

            // 2. Cek Logika Primary Address
            // Jika user mencentang "Jadikan Utama", maka alamat lain harus jadi secondary
            if ($request->has('is_primary') && $request->is_primary == 1) {
                UserAddress::where('user_id', $user->id)->update(['is_primary' => false]);
                $isPrimary = true;
            } else {
                // Jika ini alamat pertama user, otomatis jadikan primary
                $isPrimary = UserAddress::where('user_id', $user->id)->count() === 0;
            }

            // 3. Simpan ke Database
            UserAddress::create([
                'user_id'      => $user->id,
                'address_type' => $validated['address_type'],
                'address_line' => $validated['address_line'],

                // Data dari API (via Hidden Input)
                'city_id'      => $validated['city_id'],
                'city'         => $validated['city'],
                'province'     => $validated['province'],
                'postal_code'  => $validated['postal_code'],

                'country'      => 'Indonesia', // Default
                'is_primary'   => $isPrimary
            ]);

            DB::commit();
            return redirect()->route('profile.index')->with('success', 'Alamat berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menyimpan alamat: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Update Alamat
     */
    public function update(Request $request, $id)
    {
        $address = UserAddress::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'address_type' => 'required|string|max:50',
            'address_line' => 'required|string',
            'city_id'      => 'required|numeric',
            'city'         => 'required|string',
            'province'     => 'required|string',
            'postal_code'  => 'required|string',
            'is_primary'   => 'nullable|boolean',
        ]);

        DB::beginTransaction();
        try {
            // Logika Primary Address
            if ($request->has('is_primary') && $request->is_primary == 1) {
                // Jika diset primary, yang lain dimatikan
                UserAddress::where('user_id', Auth::id())
                    ->where('id', '!=', $id)
                    ->update(['is_primary' => false]);
                $isPrimary = true;
            } else {
                // Jika alamat ini sebelumnya primary dan di-uncheck,
                // kita harus memastikan tetap ada 1 primary (opsional, tergantung bisnis logic)
                // Di sini kita biarkan saja apa adanya sesuai input user
                $isPrimary = false;
            }

            $address->update([
                'address_type' => $validated['address_type'],
                'address_line' => $validated['address_line'],

                // Update Data Lokasi
                'city_id'      => $validated['city_id'],
                'city'         => $validated['city'],
                'province'     => $validated['province'],
                'postal_code'  => $validated['postal_code'],

                'is_primary'   => $isPrimary
            ]);

            DB::commit();
            return redirect()->route('profile.index')->with('success', 'Alamat berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal update alamat: ' . $e->getMessage());
        }
    }
}
