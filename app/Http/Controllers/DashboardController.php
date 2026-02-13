<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __construct(
        protected LaporanPenjualanService $laporanService,
        protected MonitoringStokService $stokService,
    ) {
    }

    public function index()
    {
        $TanggalHariIni = Carbon::today();

        return view('dashboard', [
            'TanggalHariIni'     => $TanggalHariIni,
            'ringkasan'          => $this->laporanService->ringkasanHariIni(),
            'produkTerlaris'     => $this->laporanService->produkTerlarisHariIni(),
            'produkStokRendah'   => Produk::whereBetween('stok', [1, 5])->paginate(5),
            'produkStokHabis'    => Produk::where('stok', 0)->paginate(5),
        ]);
    }
}
