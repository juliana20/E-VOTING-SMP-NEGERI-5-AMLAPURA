<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Transaksi_sampah_m;
use Validator;
use DataTables;
use DateTime;
use Helpers;
use DB;
use Illuminate\Validation\Rule;
use Response;
use PDF;

class TransaksiSampahController extends Controller
{
    protected $model;
    public function __construct(Transaksi_sampah_m $model)
    {
        $this->model = $model;
        $this->nameroutes = 'transaksi-retribusi-sampah';
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
            'title'             => 'Transaksi Retribusi Sampah',
            'header'            => 'Data Transaksi Retribusi Sampah',
            'urlDatatables'     => $this->nameroutes.'/datatables',
            'idDatatables'      => 'dt_retribusi_sampah'
        );
        return view('transaksi_sampah.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'kode_transaksi_sampah' => $this->model->gen_code('SP'),
            'tanggal' => date('Y-m-d'),
            'jumlah' => Helpers::config_item('upah_pungut'),
            'biaya_jasa' => Helpers::config_item('biaya_jasa')
        ];
        $data = array(
            'title'             => 'Transaksi Retribusi Sampah',
            'header'            => 'Buat Transaksi Retribusi Sampah',
            'item'                  => (object) $item,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'nameroutes'            => $this->nameroutes,
        );

        //jika form sumbit
        if($request->post())
        {
            $header = $request->input('f');
            $header['user_id'] = Helpers::getId();
            $validator = Validator::make( $header, $this->model->rules['insert']);
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors()->first(),
                    'status' => 'error',
                    'code' => 500,
                ];
                return Response::json($response);
            }
            DB::beginTransaction();
            try {
                $header['kode_transaksi_sampah'] = $this->model->gen_code('SP');
                $header['tanggal'] = date('Y-m-d h:i:s', strtotime($header['tanggal']));
                $this->model->insert_data($header);
                DB::commit();
    
                $response = [
                    "message" => 'Transaksi retribusi sampah berhasil dibuat',
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

        return view('transaksi_sampah.form', $data);

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
            'title'             => 'Transaksi Retribusi Sampah',
            'header'            => 'Ubah Transaksi Retribusi Sampah',
            'item'                      => $get_data,
            'is_edit'                   => TRUE,
            'submit_url'                => url()->current(),
            'nameroutes'                => $this->nameroutes,
        ];

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = $request->input('f');
           //validasi dari model
           $validator = Validator::make( $header,[
                'kode_transaksi_sampah' => ['required', Rule::unique('t_sampah')->ignore($get_data->kode_transaksi_sampah, 'kode_transaksi_sampah')]
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
                    "message" => 'Transaksi retribusi sampah berhasil diperbarui',
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
        
        return view('transaksi_sampah.form', $data);
    }

    public function show(Request $request, $id)
    {
        $get_data = $this->model->get_one($id);
        $data = [
            'title'      => 'Transaksi Retribusi Sampah',
            'header'     => 'Lihat Transaksi Retribusi Sampah',
            'item'       => $get_data,
            'is_edit'    => TRUE,
            'submit_url' => url()->current(),
            'nameroutes' => $this->nameroutes,
        ];

        return view('transaksi_sampah.show', $data);
    }


    public function cetak_nota($id)
    {
        $get_data = $this->model->get_one($id);
        $data = [
            'item'  => $get_data,
            'title' => 'NOTA TRANSAKSI',
        ];
        $pdf = PDF::loadView('transaksi_sampah.print.cetak_nota', $data)->setPaper('a5', 'portait');
        return $pdf->stream('Bukti Pembayaran Sampah'.'.pdf'); 
    }

    public function datatables_collection()
    {
        $data = $this->model->get_all();
        return Datatables::of($data)->make(true);
    }


}
