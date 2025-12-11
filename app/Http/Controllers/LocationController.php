<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    public function searchCities(Request $request)
    {
        $search = $request->input('q');

        if (strlen($search) < 3) {
            return response()->json([]);
        }

        try {
            $response = Http::withHeaders([
                'key' => env('KOMERCE_API_KEY'),
            ])->get("https://rajaongkir.komerce.id/api/v1/destination/domestic-destination", [
                'search' => $search,
                'limit' => 20
            ]);

            if ($response->successful()) {
                $data = $response->json()['data'] ?? [];

                $formatted = collect($data)->map(function($item) {
                    // 1. Susun Nama Lengkap (Hirarki)
                    // Format: [Subdistrict], [City], [Province], [Zip Code]
                    $parts = [];

                    // Cek apakah ada nama kelurahan/kecamatan (subdistrict_name)
                    if (!empty($item['subdistrict_name'])) {
                        $parts[] = strtoupper($item['subdistrict_name']);
                    }

                    // Cek nama kota/kabupaten
                    if (!empty($item['city_name'])) {
                        // Tambahkan prefix tipe jika ada (misal: KAB. SUKOHARJO)
                        $type = isset($item['type']) ? (($item['type'] == 'Kota') ? 'KOTA' : 'KAB.') : '';
                        $parts[] = trim($type . ' ' . strtoupper($item['city_name']));
                    }

                    // Cek nama provinsi
                    if (!empty($item['province_name'])) {
                        $parts[] = strtoupper($item['province_name']);
                    }

                    // Cek kode pos
                    // Prioritas: zip_code -> postal_code
                    $postal = $item['zip_code'] ?? $item['postal_code'] ?? null;
                    if (!empty($postal)) {
                        $parts[] = $postal;
                    }

                    // Gabungkan dengan pemisah koma
                    $fullText = implode(', ', $parts);

                    return [
                        'id' => $item['id'],
                        // INI KUNCINYA: 'text' berisi string lengkap yang diminta user
                        'text' => $fullText,

                        'city_name' => $item['city_name'],
                        'province' => $item['province_name'],
                        'postal_code' => $postal,
                        'subdistrict' => $item['subdistrict_name'] ?? '',
                        'type' => $item['type'] ?? 'Kota'
                    ];
                });

                return response()->json($formatted);
            }

            return response()->json([]);

        } catch (\Exception $e) {
            return response()->json([]);
        }
    }
}
