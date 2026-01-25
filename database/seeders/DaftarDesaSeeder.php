<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaftarDesaSeeder extends Seeder
{
    public function run(): void
    {
        $villages = [
            // Borong
            ['kecamatan' => 'Borong', 'nama' => 'Kota Ndora', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Borong', 'nama' => 'Rana Loba', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Borong', 'nama' => 'Satar Peot', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Borong', 'nama' => 'Balus Permai', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Bangka Kantar', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Benteng Raja', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Benteng Riwu', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Compang Ndejing', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Compang Tenda', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Golo Kantar', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Golo Lalong', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Golo Leda', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Gurung Liwut', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Nanga Labang', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Ngampang Mas', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Poco Rii', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Rana Masak', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Waling', 'type' => 'Desa'],

            // Poco Ranaka (Lamba Leda Selatan)
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Bangka Leleng', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Mandosawu', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Nggalak Leleng', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Bangka Kuleng', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Bangka Pau', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Bea Waek', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Compang Laho', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Compang Wesang', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Compang Weluk', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Deno', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Golo Lobos', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Golo Ndari', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Golo Nderu', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Golo Rengket', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Golo Wune', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Gurung Turi', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Lenang', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Lento', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Leong', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Melo', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Poco Lia', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Pocong', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Satar Tesem', 'type' => 'Desa'],
            ['kecamatan' => 'Poco Ranaka', 'nama' => 'Watu Lanur', 'type' => 'Desa'],

            // Lamba Leda
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Compang Deru', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Compang Mekar', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Compang Necak', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Goreng Meni', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Goreng Meni Utara', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Golo Lembur', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Golo Munga', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Golo Nimbung', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Golo Paleng', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Golo Rentung', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Lamba Keli', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Tengku Lawar', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Tengku Leda', 'type' => 'Desa'],

            // Sambi Rampas
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Buti', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Compang Congkar', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Compang Lawi', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Golo Ngawan', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Golo Pari', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Kembang Mekar', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Lada Mese', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Nampar Sepang', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Nanga Mbaling', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Nanga Mbaur', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Rana Mese', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Satar Nawang', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Wea', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Wela Lada', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Golo Wangkung', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Golo Wangkung Barat', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Golo Wangkung Utara', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Nanga Baras', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Pota', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Ulung Baras', 'type' => 'Kelurahan'],

            // Rana Mese
            ['kecamatan' => 'Rana Mese', 'nama' => 'Bangka Kempo', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Bangka Masa', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Bea Ngencung', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Compang Kantar', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Compang Kempo', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Compang Loni', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Compang Teber', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Golo Loni', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Golo Meleng', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Golo Ros', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Golo Rutuk', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Lalang', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Lidi', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Rondo Woing', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Sano Lokom', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Satar Lahing', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Satar Lenda', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Sita', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Torok Golo', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Wae Nggori', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Watu Mori', 'type' => 'Desa'],

            // Kota Komba
            ['kecamatan' => 'Kota Komba', 'nama' => 'Bamo', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Golo Meni', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Golo Ndele', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Golo Nderu', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Golo Tolang', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Gunung', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Gunung Baru', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Komba', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Lembur', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Mbengan', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Mokel', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Mokel Morid', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Paan Leleng', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Pari', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Pong Ruan', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Rana Kolong', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Rana Mbeling', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Rana Mbata', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Ruan', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Rongga Koe', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Tanah Rata', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Watu Nggene', 'type' => 'Kelurahan'],

            // Lamba Leda Timur
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Arus', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Bangka Arus', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Benteng Rampas', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Benteng Wunis', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Colol', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Compang Raci', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Compang Wunis', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Golo Lero', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Ngkiong Dora', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Rende Nao', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Rengkam', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Tango Molas', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Ulu Wae', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Urung Dora', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Wangkung Weli', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Watu Arus', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Wejang Mali', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Wejang Mawe', 'type' => 'Desa'],

            // Elar
            ['kecamatan' => 'Elar', 'nama' => 'Tiwu Riwu', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Elar', 'nama' => 'Biting', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Golo Lijun', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Golo Munda', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Habi Sese', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Kalo', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Legur Lai', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Lengko Namut', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Macang Tanggar', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Onto Jogeh', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Pangga', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Rana Kulan', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Sisir', 'type' => 'Desa'],

            // Elar Selatan
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Lindi', 'type' => 'Kelurahan'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Golo Ngawan', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Golo Wuas', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Langga Sai', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Mosi Ngena', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Nanga Meje', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Nitu', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Paan Waru', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Sangan Kalo', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Sipa', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Taju', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Wae Ridi', 'type' => 'Desa'],
        ];

        foreach ($villages as $v) {
            $fullName = $v['type'] . ' ' . $v['nama'];

            DB::table('desas')->updateOrInsert(
                ['nama_desa' => $fullName, 'kecamatan' => $v['kecamatan']],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
