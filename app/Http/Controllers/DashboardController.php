<?php 

namespace App\Http\Controllers; 

use App\Services\LaporanPenjualanService; 
use App\Services\MonitoringStokService; 
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller 
{ 
    public function __construct( 
        protected LaporanPenjualanService $laporanService, 
        protected MonitoringStokService $stokService, 
    ) { } 

    public function index() 
    { 
        $TanggalHariIni = now(); 
        
        $ringkasan = [ 
            'total_penjualan' => 113739451, 
            'total_transaksi' => 24, 
            'total_cash' => 32858148, 
            'total_non_tunai' => 80881303 
        ]; 

        $perPage = 5;

        // 1. Data Dummy Stok Rendah (Tabel Kiri Atas)
        $dummyStokRendah = collect([
            (object)['nama' => 'culpa ullam rem', 'stok' => 1],
            (object)['nama' => 'rerum ullam corrupti', 'stok' => 1],
            (object)['nama' => 'enim aut eum', 'stok' => 2],
            (object)['nama' => 'voluptas sequi ea', 'stok' => 2],
            (object)['nama' => 'est est est', 'stok' => 3],
            (object)['nama' => 'dummy produk tambahan 1', 'stok' => 4],
        ]);

        // 2. Data Dummy Habis Stok (Tabel Kanan Atas)
        $dummyHabisStok = collect([
            (object)['nama' => 'ducimus nihil molestiae', 'stok' => 0],
            (object)['nama' => 'expedita unde deleniti', 'stok' => 0],
            (object)['nama' => 'fugiat repellendus fuga', 'stok' => 0],
            (object)['nama' => 'illum quis illum', 'stok' => 0],
            (object)['nama' => 'nam expedita tempora', 'stok' => 0],
            (object)['nama' => 'produk habis cadangan 1', 'stok' => 0],
        ]);

        // 3. Data Dummy Best Seller Baru (Tabel Paling Bawah)
        $dummyBestSeller = collect([
            (object)['nama' => 'enim nulla quia', 'stok' => 326, 'total_terjual' => 23],
            (object)['nama' => 'qui illo aut', 'stok' => 0, 'total_terjual' => 19],
            (object)['nama' => 'sed aspernatur optio', 'stok' => 98, 'total_terjual' => 17],
            (object)['nama' => 'dicta neque atque', 'stok' => 71, 'total_terjual' => 17],
            (object)['nama' => 'ipsum ut in', 'stok' => 153, 'total_terjual' => 17],
        ]);

        $pageStok = LengthAwarePaginator::resolveCurrentPage('page_stok');
        $pageHabis = LengthAwarePaginator::resolveCurrentPage('page_habis');

        $produkStokRendah = new LengthAwarePaginator(
            $dummyStokRendah->forPage($pageStok, $perPage),
            $dummyStokRendah->count(),
            $perPage,
            $pageStok,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'pageName' => 'page_stok']
        );

        $produkTerlaris = new LengthAwarePaginator(
            $dummyHabisStok->forPage($pageHabis, $perPage),
            $dummyHabisStok->count(),
            $perPage,
            $pageHabis,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'pageName' => 'page_habis']
        );

        // Kirim variabel baru $produkTerlarisAsli ke View
        $produkTerlarisAsli = $dummyBestSeller;

        return view('dashboard', compact('TanggalHariIni', 'ringkasan', 'produkStokRendah', 'produkTerlaris', 'produkTerlarisAsli')); 
    } 
}
