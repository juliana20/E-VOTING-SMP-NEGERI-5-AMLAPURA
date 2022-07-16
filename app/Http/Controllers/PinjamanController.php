<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Pinjaman_m;
use App\Http\Model\Pinjaman_detail_m;
use App\Http\Model\Tabungan_m;
use App\Http\Model\Akun_m;
use App\Http\Model\Nasabah_m;
use Validator;
use DataTables;
use Illuminate\Validation\Rule;
use Helpers;
use DB;
use Response;
use PDF;
use DateTime;
use DatePeriod;
use DateInterval;

class PinjamanController extends Controller
{
    
    protected $option_jangka_waktu = [
        ['id' => '365','value' => '1', 'bulan' => '12', 'desc' => '1 Tahun'],
        ['id' => '730','value' => '2','bulan' => '24', 'desc' => '2 Tahun'],
        ['id' => '1095.75','value' => '3', 'bulan' => '36','desc' => '3 Tahun'],
        ['id' => '1461','value' => '4', 'bulan' => '48','desc' => '4 Tahun'],
        ['id' => '1826.25','value' => '5', 'bulan' => '60','desc' => '5 Tahun'],
        ['id' => '2191.5','value' => '6', 'bulan' => '72','desc' => '6 Tahun'],
        ['id' => '2556.75','value' => '7', 'bulan' => '84','desc' => '7 Tahun'],
        ['id' => '2922','value' => '8', 'bulan' => '96','desc' => '8 Tahun'],
        ['id' => '3287.25','value' => '9', 'bulan' => '108','desc' => '9 Tahun'],
        ['id' => '3652.5','value' => '10', 'bulan' => '120','desc' => '10 Tahun'],
    ];
    public function __construct()
    {
        $this->model = New Pinjaman_m;
        $this->model_detail = New Pinjaman_detail_m;
        $this->model_akun = New Akun_m;
        $this->model_nasabah = New Nasabah_m;
        $this->model_tabungan = New Tabungan_m;
        $this->nameroutes = 'pinjaman';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
   {
        $data = array(
            'nameroutes'        => $this->nameroutes,
            'title'             => 'Data Pinjaman',
            'breadcrumb'        => 'List Data Pinjaman',
            'headerModalTambah' => 'TAMBAH DATA PINJAMAN',
            'headerModalEdit'   => 'UBAH DATA PINJAMAN',
        );
        return view('pinjaman.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'id_pinjaman' => $this->model->gen_no_pinjaman('KR'),
            'tgl_realisasi' => date('Y-m-d'),
            'jatuh_tempo' => date('Y-m-d'),
            'id_user' => Helpers::getId(),
            'jangka_waktu' => 1
        ];
        $data = array(
            'item'                  => (object) $item,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'option_akun'           => $this->model_akun->get_all(),
            'nameroutes'            => $this->nameroutes,
            'option_jangka_waktu'   => $this->option_jangka_waktu
        );

        //jika form sumbit
        if($request->post())
        {
            $data_post = array_merge($item, $request->input('f'));
            $data_post['id_pinjaman'] = $this->model->gen_no_pinjaman('KR');
            $data_post['sisa_pinjaman'] = $data_post['angsuran'] * $data_post['jangka_waktu'];
            $data_post['sisa_bunga'] = $data_post['nominal_bunga'];
            
            // $details= [
            //     'id_pinjaman' => $data_post['id_pinjaman'],
            //     'tanggal' => $data_post['tgl_realisasi'],
            //     'debet' => 0,
            //     'kredit' => $data_post['jumlah_diterima'],
            //     'id_user' => Helpers::getId(),
            //     'saldo' => $data_post['jumlah_diterima'],
            //     'id_akun'  => $data_post['id_akun'],
            // ];

            DB::beginTransaction();
            try {
                $this->model->insert_data($data_post);
                // $this->model_detail->insert_data($details);
                DB::commit();
    
                $response = [
                    "message" => 'Data pinjaman berhasil dibuat',
                    'status' => 'success',
                    'code' => 200,
                ];
    
            } catch (\Exception $e) {
                DB::rollback();
                $response = [
                    "message" => $e->getMessage(),
                    'status' => 'error',
                    'code' => 500,
                    
                ];
            }
    
            return Response::json($response);
        }

        return view('pinjaman.form', $data);

    }

    public function bayar(Request $request, $id)
    {
        $get_data = DB::table('tb_pinjaman as a')
                      ->join('tb_nasabah as b','a.id_nasabah','=','b.id_nasabah')
                      ->select('a.*','b.nama_nasabah')
                      ->where('a.id_pinjaman', $id)
                      ->first();

        $data = array(
            'title'                 => 'Pembayaran Pinjaman',  
            'item'                  => $get_data,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'option_akun'           => $this->model_akun->get_all(),
            'nameroutes'            => $this->nameroutes,
            'option_jangka_waktu'   => $this->option_jangka_waktu,
            'jumlah_sudah_dibayar'  => $this->model_detail->get_jumlah_sudah_dibayar($get_data->id_pinjaman),
            'tanggal_bayar_terakhir' => $this->model_detail->get_tanggal_bayar_terakhir($get_data->id_pinjaman),
            'jumlah_pokok_sudah_dibayar'  => $this->model_detail->get_jumlah_pokok_sudah_dibayar($get_data->id_pinjaman),
        );

        //jika form sumbit
        if($request->post())
        {
            $data_post = array_merge($request->input('f'));
            $data_post['id_pinjaman'] = $get_data->id_pinjaman;
            $data_post['id_user'] = Helpers::getId();
            $data_post['sisa_bunga'] = $get_data->sisa_bunga - $data_post['bunga'];

            $header['sisa_pinjaman'] = $data_post['sisa_pinjaman'];
            $header['sisa_bunga'] = $get_data->sisa_bunga - $data_post['bunga'];
            
            DB::beginTransaction();
            try {
                $this->model_detail->insert_data($data_post);
                $this->model->update_data($header, $get_data->id);
                DB::commit();
    
                $response = [
                    "message" => 'Pembayaran pinjaman berhasil dibuat',
                    'status' => 'success',
                    'code' => 200,
                ];
    
            } catch (\Exception $e) {
                DB::rollback();
                $response = [
                    "message" => $e->getMessage(),
                    'status' => 'error',
                    'code' => 500,
                    
                ];
            }
    
            return Response::json($response);
        }

        if($get_data->menetap == 1){
            return view('pinjaman.form.bayar', $data);
        }else{
            return view('pinjaman.form.bayar_menurun', $data);
        }


    }
    public function lunas(Request $request, $id)
    {
        $get_data = DB::table('tb_pinjaman as a')
                      ->join('tb_nasabah as b','a.id_nasabah','=','b.id_nasabah')
                      ->select('a.*','b.nama_nasabah')
                      ->where('a.id_pinjaman', $id)
                      ->first();

        $data = array(
            'title'                 => 'Pelunasan Pinjaman',  
            'item'                  => $get_data,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'option_akun'           => $this->model_akun->get_all(),
            'nameroutes'            => $this->nameroutes,
            'option_jangka_waktu'   => $this->option_jangka_waktu,
            'jumlah_sudah_dibayar'  => $this->model_detail->get_jumlah_sudah_dibayar($get_data->id_pinjaman),
            'tanggal_bayar_terakhir' => $this->model_detail->get_tanggal_bayar_terakhir($get_data->id_pinjaman),
            'jumlah_pokok_sudah_dibayar'  => $this->model_detail->get_jumlah_pokok_sudah_dibayar($get_data->id_pinjaman),
            'jumlah_bunga_sudah_dibayar'  => $this->model_detail->get_jumlah_bunga_sudah_dibayar($get_data->id_pinjaman)
        );

        //jika form sumbit
        if($request->post())
        {
            $data_post = array_merge($request->input('f'));
            $data_post['id_pinjaman'] = $get_data->id_pinjaman;
            $data_post['id_user'] = Helpers::getId();

            $header['sisa_pinjaman'] = 0;
            $header['sisa_bunga'] = 0;
            $header['lunas'] = 1;
            
            DB::beginTransaction();
            try {
                $this->model_detail->insert_data($data_post);
                $this->model->update_data($header, $get_data->id);
                DB::commit();
    
                $response = [
                    "message" => 'Pelunasan pinjaman berhasil',
                    'status' => 'success',
                    'code' => 200,
                ];
    
            } catch (\Exception $e) {
                DB::rollback();
                $response = [
                    "message" => $e->getMessage(),
                    'status' => 'error',
                    'code' => 500,
                    
                ];
            }
    
            return Response::json($response);
        }

        if($get_data->menetap == 1)
        {
            return view('pinjaman.form.lunas', $data);
        }else{
            return view('pinjaman.form.lunas_menurun', $data);
        }


    }
    public function details(Request $request, $id)
    {
        $get_data = DB::table('tb_pinjaman as a')
                      ->join('tb_nasabah as b','a.id_nasabah','=','b.id_nasabah')
                      ->select('a.*','b.nama_nasabah')
                      ->where('a.id_pinjaman', $id)
                      ->first();

        $data = array(
            'title'                 => 'Detail Pinjaman',  
            'item'                  => $get_data,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'option_akun'           => $this->model_akun->get_all(),
            'nameroutes'            => $this->nameroutes,
            'option_jangka_waktu'   => $this->option_jangka_waktu,
            'jumlah_sudah_dibayar'  => $this->model_detail->get_jumlah_sudah_dibayar($get_data->id_pinjaman),
            'tanggal_bayar_terakhir' => $this->model_detail->get_tanggal_bayar_terakhir($get_data->id_pinjaman),
            'jumlah_pokok_sudah_dibayar'  => $this->model_detail->get_jumlah_pokok_sudah_dibayar($get_data->id_pinjaman),
            'jumlah_bunga_sudah_dibayar'  => $this->model_detail->get_jumlah_bunga_sudah_dibayar($get_data->id_pinjaman),
            'collection'                  => $this->model_detail->get_all_collection($get_data->id_pinjaman),
        );

        //jika form sumbit
        if($request->post())
        {
            $data_post = array_merge($request->input('f'));
            $data_post['id_pinjaman'] = $get_data->id_pinjaman;
            $data_post['id_user'] = Helpers::getId();

            $header['sisa_pinjaman'] = 0;
            $header['sisa_bunga'] = 0;
            $header['lunas'] = 1;
            
            DB::beginTransaction();
            try {
                $this->model_detail->insert_data($data_post);
                $this->model->update_data($header, $get_data->id);
                DB::commit();
    
                $response = [
                    "message" => 'Item data baru berhasil dibuat',
                    'status' => 'success',
                    'code' => 200,
                ];
    
            } catch (\Exception $e) {
                DB::rollback();
                $response = [
                    "message" => $e->getMessage(),
                    'status' => 'error',
                    'code' => 500,
                    
                ];
            }
    
            return Response::json($response);
        }

        return view('pinjaman.form.details', $data);

    }
    public function angsuran()
    {
         $data = array(
             'nameroutes'        => $this->nameroutes,
             'title'             => 'Data Angsuran Nasabah',
             'breadcrumb'        => 'List Data Angsuran Nasabah',
         );
         return view('pinjaman.datatable.angsuran',$data);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

    }

    public function get_saldo($id)
    {
        $debet  = $this->model_tabungan->get_debet_tabungan($id);
        $kredit = $this->model_tabungan->get_kredit_tabungan($id);
        $saldo  = $kredit - $debet;

        $response = [
            "saldo" => $saldo,
            'status' => 'success',
            'code' => 200,
        ];

        return Response::json($response); 
    }
    public function detail(Request $request, $id)
    {
        $get_data = DB::table("tb_tabungan_berjangka as a")
                    ->join('tb_nasabah as b','a.id_nasabah','=','b.id_nasabah')
                    ->where('a.id_tabungan_berjangka', $id)
                    ->select('a.*','b.nama_nasabah')
                    ->first();
        $count_setoran = DB::table('tb_tabungan_berjangka_detail')
                            ->where('id_tabungan_berjangka', $id)
                            ->where('kredit','<>', 0)
                            ->where('debet','=', 0)
                            ->get();

        $data = [
            'title'         => 'Detail Tabungan Berjangka',
            'item'          => $get_data,
            'nameroutes'    => $this->nameroutes,
            'saldo'         => self::get_saldo($get_data->id_tabungan_berjangka),
            'sisa_setoran'  => ($get_data->jangka_waktu_bulan - count($count_setoran)) * $get_data->nominal_tabungan_berjangka,
            'sisa_bulan'  => ($get_data->jangka_waktu_bulan - count($count_setoran)),
            'collection'    => $this->model->get_collection($get_data->id_tabungan_berjangka),
            'submit_url'    => url()->current(),   
        ];
        
        return view('tabungan_berjangka.detail', $data);
    }

    public function proses(Request $request, $id)
    {
        $get_data = $this->model_detail->get_one($id);

        $data = [
            'title'         => 'Proses Angsuran Pinjaman',
            'item'          => $get_data,
            'nameroutes'    => $this->nameroutes,
            'collection'    => $this->model_detail->get_all_collection($get_data->id_pinjaman),
            'submit_url'    => url()->current(),   
        ];

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            // $header = $request->input('f');
            //insert data
            DB::beginTransaction();
            try {
                $this->model_detail->update_by(['proses' => 1],['id' => $id]);
                DB::commit();

                $response = [
                    "message" => 'Setoran pembayaran pinjaman berhasil di proses',
                    'status' => 'success',
                    'code' => 200,
                ];
           
            } catch (\Exception $e) {
                DB::rollback();
                $response = [
                    "message" => $e->getMessage(),
                    'status' => 'error',
                    'code' => 500,
                    
                ];
            }
            return Response::json($response); 
        }
        
        return view('pinjaman.form.angsuran', $data);
    }


    public function cetak_detail($id)
    {
        $get_data = $this->model_detail->get_one($id);
        $data = [
            'label' => 'Jumlah Setor',
            'sisa_pinjaman' => $get_data->sisa_pinjaman,
            'item'  => $get_data,
            'title' => 'Bukti Setoran Angsuran',
        ];

        // return view('laporan.print.kategori_keuangan', $data);
        $pdf = PDF::loadView('pinjaman.print.cetak_bukti_angsuran', $data)->setPaper('a5', 'portait');
        return $pdf->stream('Bukti Setoran Angsuran.pdf'); 
    }

    public function simulasi(Request $request, $jumlah_pinjaman, $biaya_materai, $biaya_asuransi, $jangka_waktu, $bunga_pinjaman, $tgl_realisasi, $jatuh_tempo, $menetap, $nominal_bunga, $biaya_admin)
    {
        // $angsuran = ($jumlah_pinjaman / $jangka_waktu) +  (($jumlah_pinjaman * $bunga_pinjaman) / $jangka_waktu);
        // $angsuran = ($jumlah_pinjaman / $jangka_waktu) +  (($jumlah_pinjaman * $bunga_pinjaman));
        $angsuran = $jumlah_pinjaman / $jangka_waktu;
        $item = [
            'angsuran' => $angsuran,
            'bunga_pinjaman' => $bunga_pinjaman,
            'jangka_waktu' =>  $jangka_waktu,
            'biaya_asuransi' => $biaya_asuransi,
            'biaya_materai' => $biaya_materai,
            'jumlah_pinjaman' => $jumlah_pinjaman,
            'tgl_realisasi' => $tgl_realisasi,
            'jatuh_tempo' => $jatuh_tempo,
            'menetap' => $menetap,
            'nominal_bunga' => $nominal_bunga,
            'biaya_admin' => $biaya_admin
        ];

        $start    = new DateTime( $tgl_realisasi);
        $start->modify('first day of next month');
        $end      = new DateTime($jatuh_tempo);
        $end->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        $sisa_pinjaman_menetap = $jumlah_pinjaman;
        $sisa_pinjaman_menurun = $jumlah_pinjaman;

        if($menetap == 1):
            foreach ($period as $dt) {
                // $total_angsuran = ($jumlah_pinjaman / $jangka_waktu) +  (($jumlah_pinjaman * $bunga_pinjaman));
                $total_angsuran = ($jumlah_pinjaman / $jangka_waktu);
                $sisa_pinjaman_menetap = $sisa_pinjaman_menetap - $total_angsuran;
                $collections[] = [
                    'periode' => $dt->format("M Y"),
                    'angsuran_bunga' => round(($jumlah_pinjaman * $bunga_pinjaman)),
                    'angsuran_pokok' => round($jumlah_pinjaman / $jangka_waktu),
                    'total_angsuran' => round($total_angsuran + ($jumlah_pinjaman * $bunga_pinjaman)),
                    'sisa_pinjaman' =>  round($sisa_pinjaman_menetap),
                ];
            }
        else:
            foreach ($period as $dt) {
                // $total_angsuran = $sisa_pinjaman_menurun * $bunga_pinjaman + ($jumlah_pinjaman / $jangka_waktu);
                $total_angsuran = $jumlah_pinjaman / $jangka_waktu;
                $sisa_pinjaman_menurun = $sisa_pinjaman_menurun - $total_angsuran;
                $collections[] = [
                    'periode'       => $dt->format("M Y"),
                    'angsuran_bunga' => round(($sisa_pinjaman_menurun * $bunga_pinjaman)),
                    'angsuran_pokok' => round($jumlah_pinjaman / $jangka_waktu),
                    'total_angsuran' => round( $total_angsuran + ($sisa_pinjaman_menurun * $bunga_pinjaman)),
                    'sisa_pinjaman' =>  round($sisa_pinjaman_menurun),
                ];
            }
        endif;

        // return response()->json($collections, 200);exit;
        $data = array(
            'item'                  => (object) $item,
            'collections'             => $collections
        );

        return view('pinjaman.simulasi', $data);

    }

    public function datatables_collection()
    {
        $params = request()->all();
        $data = $this->model->get_all($params);
        return Datatables::of($data)->make(true);
    }

    public function datatables_collection_nasabah()
    {
        $data = $this->model->get_all_nasabah();
        return Datatables::of($data)->make(true);
    }

        
    public function datatables_collection_angsuran()
    {
        $params = request()->all();
        $data = $this->model->get_all_angsuran($params);
        return Datatables::of($data)->make(true);
    }

    public function pinjaman_nasabah()
    {
         $data = array(
             'nameroutes'        => $this->nameroutes,
             'title'             => 'Data Pinjaman',
             'breadcrumb'        => 'List Data Pinjaman',
             'urlDatatables'     => 'nasabah/pinjaman/datatables',
         );
         return view('pinjaman.nasabah.datatable',$data);
     }


    public function datatables_collection_pinjaman_nasabah()
    {
        $params = request()->all();
        $data = $this->model->get_all_pinjaman_nasabah($params);
        return Datatables::of($data)->make(true);
    }

}
