<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Simpanan_anggota_m;
use App\Http\Model\Akun_m;
use App\Http\Model\Nasabah_m;
use Validator;
use DataTables;
use Illuminate\Validation\Rule;
use Helpers;
use DB;
use Response;
use PDF;

class SimpananAnggotaController extends Controller
{
    public function __construct()
    {
        $this->model = New Simpanan_anggota_m;
        $this->model_akun = New Akun_m;
        $this->model_nasabah = New Nasabah_m;
        $this->nameroutes = 'simpanan-anggota';
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
            'title'             => 'Data Simpanan Anggota',
            'breadcrumb'        => 'List Data Simpanan Anggota',
            'headerModalTambah' => 'TAMBAH DATA ANGGOTA',
            'headerModalEdit'   => 'UBAH DATA ANGGOTA',
            'urlDatatables'     => $this->nameroutes.'/datatables',
            'idDatatables'      => 'dt_simpanan_anggota'
        );
        return view('simpanan_anggota.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'id_nasabah' => $this->model->gen_code('NS'),
            'tanggal_daftar' => date('Y-m-d')
        ];

        $data = array(
            'item'                  => (object) $item,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'option_jenis_kelamin'  => $this->jenis_kelamin,
            'option_status'         => $this->status,
            'nameroutes'            => $this->nameroutes,
        );

        //jika form sumbit
        if($request->post())
        {
            $header = $request->input('f');
            $header['id_nasabah'] = $this->model->gen_code('NS');
            if($header['anggota'] == 1){
                $header['anggota'] = $header['anggota'];
                $header['no_anggota'] = $this->model->gen_code_anggota('AG');
            }

            $validator = Validator::make( $header, $this->model->rules['insert']);
            if ($validator->fails()) {
                $response = [
                    'message' => $validator->errors()->first(),
                    'status' => 'error',
                    'code' => 500,
                ];
                return Response::json($response);
            }

            DB::beginTransaction();
            try {
                $this->model->insert_data($header);
                DB::commit();
    
                $response = [
                    "message" => 'Simpanan anggota berhasil dibuat',
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

        return view('nasabah.form', $data);

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $get_data = $this->model->get_one($id);
        $data = [
            'item'                      => $get_data,
            'is_edit'                   => TRUE,
            'submit_url'                => url()->current(),
            'option_jenis_kelamin'      => $this->jenis_kelamin,
            'option_status'             => $this->status,
            'nameroutes'                => $this->nameroutes,
        ];

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = $request->input('f');

            if(empty($header['anggota']) && $get_data->anggota == 1){
                $header['anggota'] = 0;
                $header['no_anggota'] = null;
            }
            
            if($header['anggota'] == 1 && $get_data->anggota != 1){
                $header['anggota'] = $header['anggota'];
                $header['no_anggota'] = $this->model->gen_code_anggota('AG');
            }


           //validasi dari model
           $validator = Validator::make( $header, [
                'id_nasabah' => [Rule::unique('tb_nasabah')->ignore($get_data->id_nasabah, 'id_nasabah')],
             ]);
           if ($validator->fails()) {
               $response = [
                   'message' => $validator->errors()->first(),
                   'status' => 'error',
                   'code' => 500,
               ];
               return Response::json($response);
           }

            //insert data
            DB::beginTransaction();
            try {
                $this->model->update_data($header, $id);
                DB::commit();

                $response = [
                    "message" => 'Data simpanan anggota berhasil diperbarui',
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
        
        return view('nasabah.form', $data);
    }

    private function get_saldo($id)
    {
        $debet  = $this->model->get_debet_simpanan_wajib($id);
        $kredit = $this->model->get_kredit_simpanan_wajib($id);
        $saldo  = $kredit - $debet;

        return $saldo;
    }
    private function get_saldo_pokok($id)
    {
        $debet  = $this->model->get_debet_simpanan_pokok($id);
        $kredit = $this->model->get_kredit_simpanan_pokok($id);
        $saldo  = $kredit - $debet;

        return $saldo;
    }
    public function simpanan_wajib(Request $request, $id)
    {
        $get_data = $this->model->get_by(['no_anggota' => $id]);

        $data = [
            'title'         => 'Simpanan Wajib Anggota',
            'item'          => $get_data,
            'nameroutes'    => $this->nameroutes,
            'saldo'         => self::get_saldo($get_data->id_nasabah),
            'collection'    => $this->model->get_collection_simpanan_wajib($get_data->id_nasabah)    
        ];

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = $request->input('f');

            if(empty($header['anggota']) && $get_data->anggota == 1){
                $header['anggota'] = 0;
                $header['no_anggota'] = null;
            }
            
            if($header['anggota'] == 1 && $get_data->anggota != 1){
                $header['anggota'] = $header['anggota'];
                $header['no_anggota'] = $this->model->gen_code_anggota('AG');
            }


           //validasi dari model
           $validator = Validator::make( $header, [
                'id_nasabah' => [Rule::unique('tb_nasabah')->ignore($get_data->id_nasabah, 'id_nasabah')],
             ]);
           if ($validator->fails()) {
               $response = [
                   'message' => $validator->errors()->first(),
                   'status' => 'error',
                   'code' => 500,
               ];
               return Response::json($response);
           }

            //insert data
            DB::beginTransaction();
            try {
                $this->model->update_data($header, $id);
                DB::commit();

                $response = [
                    "message" => 'Simpanan wajib berhasil diperbarui',
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
        
        return view('simpanan_anggota.simpanan_wajib', $data);
    }
    
    public function simpanan_pokok(Request $request, $id)
    {
        $get_data = $this->model->get_by(['no_anggota' => $id]);
        $data = [
            'title'         => 'Simpanan Pokok Anggota',
            'item'          => $get_data,
            'nameroutes'    => $this->nameroutes,
            'saldo'         => self::get_saldo_pokok($get_data->id_nasabah),
            'collection'    => $this->model->get_collection_simpanan_pokok($get_data->id_nasabah)    
        ];

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = $request->input('f');

            if(empty($header['anggota']) && $get_data->anggota == 1){
                $header['anggota'] = 0;
                $header['no_anggota'] = null;
            }
            
            if($header['anggota'] == 1 && $get_data->anggota != 1){
                $header['anggota'] = $header['anggota'];
                $header['no_anggota'] = $this->model->gen_code_anggota('AG');
            }


           //validasi dari model
           $validator = Validator::make( $header, [
                'id_nasabah' => [Rule::unique('tb_nasabah')->ignore($get_data->id_nasabah, 'id_nasabah')],
             ]);
           if ($validator->fails()) {
               $response = [
                   'message' => $validator->errors()->first(),
                   'status' => 'error',
                   'code' => 500,
               ];
               return Response::json($response);
           }

            //insert data
            DB::beginTransaction();
            try {
                $this->model->update_data($header, $id);
                DB::commit();

                $response = [
                    "message" => 'Simpanan pokok berhasil diperbarui',
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
        
        return view('simpanan_anggota.simpanan_pokok', $data);
    }
    public function lookup_form_setoran_wajib(Request $request)
    {
        $id_nasabah = $request->get('id_nasabah');
        $get_data = $this->model->get_by(['id_nasabah' => $id_nasabah]);

        $data = [
            'title'         => 'Setoran Simpanan Wajib',
            'item'          => $get_data,
            'no_bukti'      => $this->model->gen_no_bukti_setoran_wajib('TSW'),
            'submit_url'    => $this->nameroutes.'/simpan-setoran-wajib',
            'is_edit'       => FALSE,
            'nameroutes'    => $this->nameroutes,
            'saldo'         => self::get_saldo($get_data->id_nasabah),
            'option_akun'   => $this->model_akun->get_all()    
        ];

        return view('simpanan_anggota.lookup.form_simpanan_wajib', $data);
    }

    public function lookup_form_setoran_wajib_penarikan(Request $request)
    {
        $id_nasabah = $request->get('id_nasabah');
        $get_data = $this->model->get_by(['id_nasabah' => $id_nasabah]);

        $data = [
            'title'         => 'Penarikan Simpanan Wajib',
            'item'          => $get_data,
            'no_bukti'      => $this->model->gen_no_bukti_setoran_wajib('TSW'),
            'submit_url'    => $this->nameroutes.'/simpan-setoran-wajib',
            'is_edit'       => FALSE,
            'nameroutes'    => $this->nameroutes,
            'saldo'         => self::get_saldo($get_data->id_nasabah),
            'option_akun'   => $this->model_akun->get_all()    
        ];

        return view('simpanan_anggota.lookup.form_simpanan_wajib_penarikan', $data);
    }

    public function lookup_form_setoran_pokok(Request $request)
    {
        $id_nasabah = $request->get('id_nasabah');
        $get_data = $this->model->get_by(['id_nasabah' => $id_nasabah]);

        $data = [
            'title'         => 'Setoran Simpanan Pokok',
            'item'          => $get_data,
            'no_bukti'      => $this->model->gen_no_bukti_setoran_pokok('TSP'),
            'submit_url'    => $this->nameroutes.'/simpan-setoran-pokok',
            'is_edit'       => FALSE,
            'nameroutes'    => $this->nameroutes,
            'saldo'         => self::get_saldo_pokok($get_data->id_nasabah),
            'option_akun'   => $this->model_akun->get_all()    
        ];

        return view('simpanan_anggota.lookup.form_simpanan_pokok', $data);
    }

    public function lookup_form_setoran_pokok_penarikan(Request $request)
    {
        $id_nasabah = $request->get('id_nasabah');
        $get_data = $this->model->get_by(['id_nasabah' => $id_nasabah]);

        $data = [
            'title'         => 'Penarikan Simpanan Pokok',
            'item'          => $get_data,
            'no_bukti'      => $this->model->gen_no_bukti_setoran_pokok('TSP'),
            'submit_url'    => $this->nameroutes.'/simpan-setoran-pokok',
            'is_edit'       => FALSE,
            'nameroutes'    => $this->nameroutes,
            'saldo'         => self::get_saldo_pokok($get_data->id_nasabah),
            'option_akun'   => $this->model_akun->get_all()    
        ];

        return view('simpanan_anggota.lookup.form_simpanan_pokok_penarikan', $data);
    }

    public function simpan_setoran_wajib(Request $request)
    {
            //jika form sumbit
            if($request->post())
            {
                $header = $request->input('f');
                $header['id_user'] = Helpers::getId();
                $header['id_simpanan_wajib'] = $this->model->gen_no_bukti_setoran_wajib('TSW');
                

                $validator = Validator::make( $header, $this->model->rules['insert_simpanan_wajib']);
                if ($validator->fails()) {
                    $response = [
                        'message' => $validator->errors()->first(),
                        'status' => 'error',
                        'code' => 500,
                    ];
                    return Response::json($response);
                }
    
                DB::beginTransaction();
                try {
                    $this->model->insert_data_simpanan_wajib($header);
                    DB::commit();
        
                    $response = [
                        "message" => 'Setoran simpanan wajib berhasil dibuat',
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
    }
    
    public function simpan_setoran_pokok(Request $request)
    {
            //jika form sumbit
            if($request->post())
            {
                $header = $request->input('f');
                $header['id_user'] = Helpers::getId();
                $header['id_simpanan_pokok'] = $this->model->gen_no_bukti_setoran_pokok('TSP');
    
                $validator = Validator::make( $header, $this->model->rules['insert_simpanan_pokok']);
                if ($validator->fails()) {
                    $response = [
                        'message' => $validator->errors()->first(),
                        'status' => 'error',
                        'code' => 500,
                    ];
                    return Response::json($response);
                }
    
                DB::beginTransaction();
                try {
                    $this->model->insert_data_simpanan_pokok($header);
                    DB::commit();
        
                    $response = [
                        "message" => 'Setoran simpanan pokok berhasil dibuat',
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
    }

    public function tarik(Request $request, $id)
    {

        $get_nasabah = $this->model_nasabah->get_by(['no_anggota' => $id]);
        $get_saldo_pokok = self::get_saldo_pokok($get_nasabah->id_nasabah);
        $get_saldo_wajib = self::get_saldo($get_nasabah->id_nasabah);

        $data = [
            'title'         => 'Penarikan Simpanan Anggota',
            'item'          => $get_nasabah,
            'is_edit'       => FALSE,
            'nameroutes'    => $this->nameroutes,
            'saldo_pokok'   => $get_saldo_pokok,
            'saldo_wajib'   => $get_saldo_wajib,
            'submit_url'    => url()->current(),
        ];

        //jika form sumbit
        if($request->post())
        {
            $header = $request->input('f');
            DB::beginTransaction();
            try {
                $this->model_nasabah->update_by(['berhenti_anggota' => 1], ['no_anggota' => $id]);
                DB::commit();
    
                $response = [
                    "message" => 'Penarikan simpanan anggota berhasil diproses',
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

        return view('simpanan_anggota.lookup.form_penarikan', $data);
    }

    public function datatables_collection()
    {
        $params = request()->all();
        $data = $this->model->get_all( $params );
        foreach($data as $row)
        {
            $collection[] = [
                'id' => $row->id,
                'no_anggota' => $row->no_anggota,
                'no_rek_sim_pokok' => $row->no_rek_sim_pokok,
                'no_rek_sim_wajib' => $row->no_rek_sim_wajib,
                'nama_nasabah' => $row->nama_nasabah,
                'tanggal_daftar' => $row->tanggal_daftar,
                'saldo_wajib' => self::get_saldo($row->id_nasabah),
                'saldo_pokok' => self::get_saldo_pokok($row->id_nasabah),
                'berhenti_anggota' => $row->berhenti_anggota,
            ];
        }
        return Datatables::of((!empty($collection) ? $collection : []))->make(true);
    }


    
    public function tabungan_nasabah()
    {
         $data = array(
             'nameroutes'        => $this->nameroutes,
             'title'             => 'Data Simpanan Anggota',
             'breadcrumb'        => 'List Data Simpanan Anggota',
             'urlDatatables'     => 'nasabah/simpanan-anggota/datatables',
         );
         return view('simpanan_anggota.nasabah.datatable',$data);
     }


    public function datatables_collection_nasabah()
    {
        $params = request()->all();
        $data = $this->model->get_all_tabungan_nasabah($params);
        return Datatables::of($data)->make(true);
    }

    public function datatables_collection_simpanan_pokok_nasabah()
    {
        $params = request()->all();
        $data = $this->model->get_all_tabungan_pokok_nasabah($params);
        return Datatables::of($data)->make(true);
    }


    public function cetak($id)
    {
        $get_nasabah = $this->model->get_by(['no_anggota' => $id]);

        $data = [
            'label' => 'Bukti Penarikan Simpanan Anggota',
            'saldo_wajib' => self::get_saldo($get_nasabah->id_nasabah),
            'saldo_pokok' => self::get_saldo_pokok($get_nasabah->id_nasabah),
            'biaya_admin' => 50000,
            'item'  => $get_nasabah,
            'title' => 'Bukti Penarikan Simpanan Anggota',
        ];

        // return view('laporan.print.kategori_keuangan', $data);
        $pdf = PDF::loadView('simpanan_anggota.print.cetak_bukti_penarikan', $data)->setPaper('a5', 'portait');
        return $pdf->stream('Bukti Penarikan Simpanan Anggota'.'.pdf'); 
    }
}
