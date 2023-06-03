<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class ApiController extends Controller
{
    public function get_data()
    {
        // Baca file_satu.json dan file_dua.json
        $file_satu = File::get(storage_path('app/file_satu.json'));
        $file_dua = File::get(storage_path('app/file_dua.json'));
        
        // Decode JSON menjadi array
        $data_satu = json_decode($file_satu, true);
        $data_dua = json_decode($file_dua, true);
        
        // Manipulasi data
        $result = [];
        foreach ($data_satu['data'] as $item) {
            $ahass_code = $item['booking']['workshop']['code'];

            // Cari data AHASS dari file_dua.json berdasarkan ahass_code
            $ahass_data = collect($data_dua['data'])->firstWhere('code', $ahass_code);

            // Buat array baru dengan data yang dimanipulasi
            $new_item = [
                'name' => $item['name'],
                'email' => $item['email'],
                'booking_number' => $item['booking']['booking_number'],
                'book_date' => $item['booking']['book_date'],
                'ahass_code' => $ahass_code,
                'ahass_name' => $ahass_data['name'] ?? '',
                'ahass_address' => $ahass_data['address'] ?? '',
                'ahass_contact' => $ahass_data['phone_number'] ?? '',
                'ahass_distance' => $ahass_data['distance'] ?? 0,
                'motorcycle_ut_code' => $item['booking']['motorcycle']['ut_code'],
                'motorcycle' => $item['booking']['motorcycle']['name'],
            ];
            
            $result[] = $new_item;
        }
        
        // Sortir data berdasarkan 'ahass_distance'
        usort($result, function($a, $b) {
            return $a['ahass_distance'] - $b['ahass_distance'];
        });
        
        // Hasil
        $result_json = [
            'status' => 1,
            'message' => 'Data Successfully Retrieved.',
            'data' => $result,
        ];
        
        
        // Kembalikan hasil sebagai response API
        return response()->json($result_json);
    }
}
