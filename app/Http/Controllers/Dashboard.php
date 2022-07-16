<?php

namespace App\Http\Controllers;
use App\Http\Model\Tahun_ajaran_m;
use App\Http\Model\Pembayaran_m;
use App\Http\Model\Keuangan_m;
use App\Http\Model\Kelas_m;
use Illuminate\Http\Request;
use DataTables;
use Response;
use DB;
use Helpers;

class Dashboard extends Controller
{
    protected $bulan = [
        ['id' => '1', 'desc' => 'Januari'],
        ['id' => '2', 'desc' => 'Februari'],
        ['id' => '3', 'desc' => 'Maret'],
        ['id' => '4', 'desc' => 'April'],
        ['id' => '5', 'desc' => 'Mei'],
        ['id' => '6', 'desc' => 'Juni'],
        ['id' => '7', 'desc' => 'Juli'],
        ['id' => '8', 'desc' => 'Agustus'],
        ['id' => '9', 'desc' => 'September'],
        ['id' => '10', 'desc' => 'Oktober'],
        ['id' => '11', 'desc' => 'November'],
        ['id' => '12', 'desc' => 'Desember'],
    ];

    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $bulan = date('m');
            $pemasukan = DB::table('tb_mutasi_kas')
                        ->where('jenis_mutasi', 'Penerimaan')
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->select(DB::raw('sum(total) as total'))
                        ->first();
            $pemasukan_simpanan_pokok = DB::table('tb_simpanan_pokok')
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->select(DB::raw('sum(kredit) as total'))
                        ->first();
            $pemasukan_simpanan_wajib = DB::table('tb_simpanan_wajib')
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->select(DB::raw('sum(kredit) as total'))
                        ->first();
            $pemasukan_tabungan_berjangka = DB::table('tb_tabungan_berjangka_detail')
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->select(DB::raw('sum(kredit) as total'))
                        ->first();
            $pemasukan_tabungan_sukarela = DB::table('tb_tabungan_sukarela')
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->select(DB::raw('sum(kredit) as total'))
                        ->first();

            $pemasukan_bayar_pinjaman = DB::table('tb_pinjaman_detail')
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->select(DB::raw('sum(total) as total'))
                        ->first();

            $pengeluaran = DB::table('tb_mutasi_kas')
                        ->where('jenis_mutasi', 'Pengeluaran')
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->select(DB::raw('sum(total) as total'))
                        ->first();
            $pengeluaran_simpanan_pokok = DB::table('tb_simpanan_pokok')
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->select(DB::raw('sum(debet) as total'))
                        ->first();
            $pengeluaran_simpanan_wajib = DB::table('tb_simpanan_wajib')
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->select(DB::raw('sum(debet) as total'))
                        ->first();
            $pengeluaran_tabungan_berjangka = DB::table('tb_tabungan_berjangka_detail')
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->select(DB::raw('sum(debet) as total'))
                        ->first();
            $pengeluaran_tabungan_sukarela = DB::table('tb_tabungan_sukarela')
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->select(DB::raw('sum(debet) as total'))
                        ->first();
            $pengeluaran_pinjaman = DB::table('tb_pinjaman')
                        ->where(DB::raw('MONTH(tgl_realisasi)'), $bulan)
                        ->select(DB::raw('sum(jumlah_diterima) as total'))
                        ->first();
            $data = [
                'title'     => 'Beranda',
                'bulan'     => $this->bulan,
                'pemasukan' => $pemasukan->total + $pemasukan_simpanan_pokok->total + $pemasukan_simpanan_wajib->total + $pemasukan_tabungan_berjangka->total + $pemasukan_tabungan_sukarela->total + $pemasukan_bayar_pinjaman->total,
                'pengeluaran' => $pengeluaran->total + $pengeluaran_simpanan_pokok->total + $pengeluaran_simpanan_wajib->total + $pengeluaran_tabungan_berjangka->total + $pengeluaran_tabungan_sukarela->total + $pengeluaran_pinjaman->total,
            ];

            return view('dashboard.dashboard', $data);
    }

    private function _total_pemasukan($bulan, $year)
    {
            $pemasukan = DB::table('tb_mutasi_kas')
                        ->where('jenis_mutasi', 'Penerimaan')
                        ->where(DB::raw('YEAR(tanggal)'), $year)
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->select(DB::raw('sum(total) as total'))
                        ->first();
            $pemasukan_simpanan_pokok = DB::table('tb_simpanan_pokok')
                        ->select(DB::raw('sum(kredit) as total'))
                        ->where(DB::raw('YEAR(tanggal)'), $year)
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->first();
            $pemasukan_simpanan_wajib = DB::table('tb_simpanan_wajib')
                        ->select(DB::raw('sum(kredit) as total'))
                        ->where(DB::raw('YEAR(tanggal)'), $year)
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->first();
            $pemasukan_tabungan_berjangka = DB::table('tb_tabungan_berjangka_detail')
                        ->select(DB::raw('sum(kredit) as total'))
                        ->where(DB::raw('YEAR(tanggal)'), $year)
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->first();
            $pemasukan_tabungan_sukarela = DB::table('tb_tabungan_sukarela')
                        ->select(DB::raw('sum(kredit) as total'))
                        ->where(DB::raw('YEAR(tanggal)'), $year)
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->first();

            $pemasukan_bayar_pinjaman = DB::table('tb_pinjaman_detail')
                        ->select(DB::raw('sum(total) as total'))
                        ->where(DB::raw('YEAR(tanggal)'), $year)
                        ->where(DB::raw('MONTH(tanggal)'), $bulan)
                        ->first();
            $total = $pemasukan->total + $pemasukan_simpanan_pokok->total + $pemasukan_simpanan_wajib->total + $pemasukan_tabungan_berjangka->total + $pemasukan_tabungan_sukarela->total + $pemasukan_bayar_pinjaman->total;
            return ($total > 0) ? $total : 0;
    }
    private function _total_pengeluaran($bulan, $year)
    {
        
        $pengeluaran = DB::table('tb_mutasi_kas')
                ->where('jenis_mutasi', 'Pengeluaran')
                ->where(DB::raw('YEAR(tanggal)'), $year)
                ->where(DB::raw('MONTH(tanggal)'), $bulan)
                ->select(DB::raw('sum(total) as total'))
                ->first();
        $pengeluaran_simpanan_pokok = DB::table('tb_simpanan_pokok')
                ->select(DB::raw('sum(debet) as total'))
                ->where(DB::raw('YEAR(tanggal)'), $year)
                ->where(DB::raw('MONTH(tanggal)'), $bulan)
                ->first();
        $pengeluaran_simpanan_wajib = DB::table('tb_simpanan_wajib')
                ->select(DB::raw('sum(debet) as total'))
                ->where(DB::raw('YEAR(tanggal)'), $year)
                ->where(DB::raw('MONTH(tanggal)'), $bulan)
                ->first();
        $pengeluaran_tabungan_berjangka = DB::table('tb_tabungan_berjangka_detail')
                ->select(DB::raw('sum(debet) as total'))
                ->where(DB::raw('YEAR(tanggal)'), $year)
                ->where(DB::raw('MONTH(tanggal)'), $bulan)
                ->first();
        $pengeluaran_tabungan_sukarela = DB::table('tb_tabungan_sukarela')
                ->select(DB::raw('sum(debet) as total'))
                ->where(DB::raw('YEAR(tanggal)'), $year)
                ->where(DB::raw('MONTH(tanggal)'), $bulan)
                ->first();
        $pengeluaran_pinjaman = DB::table('tb_pinjaman')
                ->select(DB::raw('sum(jumlah_diterima) as total'))
                ->where(DB::raw('YEAR(tgl_realisasi)'), $year)
                ->where(DB::raw('MONTH(tgl_realisasi)'), $bulan)
                ->first();

        $total = $pengeluaran->total + $pengeluaran_simpanan_pokok->total + $pengeluaran_simpanan_wajib->total + $pengeluaran_tabungan_berjangka->total + $pengeluaran_tabungan_sukarela->total + $pengeluaran_pinjaman->total;
        return ($total > 0) ? $total : 0;
    }
    public function chart(Request $request)
    {
        $params = $request->post('header');
        $months = array(
            ['id' => 1,'bulan' => 'Januari'], 
            ['id' => 2,'bulan' => 'Februari'], 
            ['id' => 3,'bulan' => 'Maret'], 
            ['id' => 4,'bulan' => 'April'], 
            ['id' => 5,'bulan' => 'Mei'], 
            ['id' => 6,'bulan' => 'Juni'], 
            ['id' => 7,'bulan' => 'Juli'], 
            ['id' => 8,'bulan' => 'Agustus'], 
            ['id' => 9,'bulan' => 'September'], 
            ['id' => 10,'bulan' => 'Oktober'], 
            ['id' => 11,'bulan' => 'November'], 
            ['id' => 12,'bulan' => 'Desember'], 
        );

        foreach($months as $bln):
            $dataGrafik = [
                'Bulan' => $bln['bulan'],
                'Pemasukan' => self::_total_pemasukan($bln['id'], $params['year']),
                'Pengeluaran' => self::_total_pengeluaran($bln['id'], $params['year']),
            ];

            $grafik[] = $dataGrafik;
        endforeach;

        $response = array(
            "data" => (!empty($grafik)) ? $grafik : [],
            "status" => "success",
            "message" => 'Grafik',
            "code" => "200",
        );
        return Response::json($response);
    }

    
}
